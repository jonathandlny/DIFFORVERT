<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\CreateUserType;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UsersController extends AbstractController
{
    private $repoUser;
    private $passwordEncoder;

    public function __construct(UsersRepository $repoUser, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->repoUser = $repoUser;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/utilisateurs", name="user_index")
     */
    public function utilisateur(Request $request)
    {
        $users = $this->repoUser->findAll();

        return $this->render('difforvert/users/users.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/creer_utilisateur", name="user_create")
     */
    public function createUser(Request $request, UserInterface $currentUser)
    {
        $user = new Users();
        $user->setRoles([]);
        $form = $this->createForm(CreateUserType::class, $user);

        if($currentUser->getRoles()[0] == 'ROLE_ADMIN'){
            $form->add('roles', ChoiceType::class, [
                'label' => 'Role',
                'choices' => array(
                    'Responsable de production' => 'ROLE_PRODUCTION',
                    'Responsable de chaîne' => 'ROLE_CHAINE',
                    'Administrateur' => 'ROLE_ADMIN',
                ),
                'mapped' => false
            ]);
        }
        else{
            $form->add('roles', ChoiceType::class, [
                'label' => 'Role',
                'choices' => array(
                    'Responsable de production' => 'ROLE_PRODUCTION',
                    'Responsable de chaîne' => 'ROLE_CHAINE',
                ),
                'mapped' => false
            ]);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = new Users();
            $user->setFirstname($form->get("firstname")->getData());
            $user->setLastname($form->get("lastname")->getData());
            $user->setUsername($form->get("username")->getData());
            $user->setRoles([$form->get("roles")->getData()]);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $form->get("password")->getData()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('difforvert/users/createUser.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/editer_utilisateur/{username}", name="user_edit")
     * @return Response
     */
    public function edit_user(Request $request, $username, UserInterface $currentUser)
    {
        $user = $this->repoUser->findOneBy(['username' => $username]);

        $form = $this->createFormBuilder()
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'data' => $user->getFirstname(),
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom de famille',
                'data' => $user->getLastname(),
            ])
            ->add('MODIFIER', SubmitType::class, [
                'attr' => ['class' => 'btn btn-lg btn-primary',
                'style' => 'background-color: #6C8E15;']
            ])
        ;

        if($currentUser->getRoles()[0] == 'ROLE_ADMIN' && $user->getUsername() != $currentUser->getUsername() && $user->getUsername() != 'administrateur'){
            $form->add('username', TextType::class, [
                'label' => 'Nom d\'utilisateur',
                'data' => $user->getUsername(),
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => ['Responsable de production' => 'ROLE_PRODUCTION', 'Responsable de chaîne' => 'ROLE_CHAINE', 'Administrateur' => 'ROLE_ADMIN'],
                'data' => $user->getRoles()[0],
            ]);
        }
        else{
            $form->add('username', TextType::class, [
                'label' => 'Nom d\'utilisateur',
                'data' => $user->getUsername(),
                'disabled' => 'true',
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => ['Responsable de production' => 'ROLE_PRODUCTION', 'Responsable de chaîne' => 'ROLE_CHAINE'],
                'data' => $user->getRoles()[0],
            ]);
        }

        $form = $form->getForm();
        $form = $form->handleRequest($request);




        if ($form->isSubmitted() && $form->isValid()) {

            $user->setFirstname($form->get("firstname")->getData());
            $user->setLastname($form->get("lastname")->getData());
            $user->setUsername($form->get("username")->getData());
            $user->setRoles([$form->get("roles")->getData()]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('difforvert/users/editUser.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer_utilisateur/{username}", name="user_delete")
     * @return Response
     */
    public function delete_user(Request $request, $username)
    {
        $user = $this->repoUser->findOneBy(['username' => $username]);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute("user_index");
    }

    /**
     * @Route("/reinitialiser_motdepasse_utilisateur/{username}", name="user_reset_password")
     * @return Response
     */
    public function reset_password(Request $request, $username)
    {
        $user = $this->repoUser->findOneBy(['username' => $username]);

        $form = $this->createFormBuilder()
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => "Les mots de passe ne correspondent pas !",
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe', 'error_bubbling' => true,],
                'second_options' => ['label' => 'Répéter le mot de passe'],
            ])
            ->add('MODIFIER', SubmitType::class, [
                'attr' => ['class' => 'btn btn-lg btn-primary',
                    'style' => 'background-color: #6C8E15;']
            ])
            ->getForm()
            ->handleRequest($request)
        ;

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword($this->passwordEncoder->encodePassword($user, $form->get("password")->getData()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('difforvert/users/resetPassword.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
?>
