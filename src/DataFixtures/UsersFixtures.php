<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $admin = new Users();
        $admin->setFirstname("Administrateur");
        $admin->setLastname("Administrateur");
        $admin->setUsername('admin');
        $admin->setRoles(["ROLE_ADMIN"]);
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, '2Bsystem99'));
        $manager->persist($admin);
        $manager->flush();
    }
}
