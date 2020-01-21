<?php

namespace App\Controller;

use App\Entity\Chaines;
use App\Entity\Lignes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChaineController extends AbstractController
{
     /**
     * @Route("/chaines", name="chaine_index")
     */
    public function index()
    {
        $allChaines = $this->getDoctrine()->getRepository(Chaines::class);
        $chaine = $allChaines->findAll(array(), array('chaineNumber' => 'ASC'));

        return $this->render('difforvert/chaines/chaine.html.twig', [
            'chaines' => $chaine,
        ]);
    }

    /**
     * @Route("/chaines/edition/{chaineNumber}", name="chaine_edit")
     */
    public function editChaine($chaineNumber)
    {
        $allLignes = $this->getDoctrine()->getRepository(Lignes::class);
        $ligne = $allLignes->findBy(array('chaineNumber' => $chaineNumber),array('nbrPerson' => 'ASC'));

        return $this->render('difforvert/chaines/chaine_edit.html.twig', ['chaineNumberChaine' => $chaineNumber,'lignes' => $ligne]);
    }

    /**
     * @Route("/chaines/suppression/{chaineNumber}", name="chaine_suppression")
     */
    public function deleteChaine($number, Request $request)
    {
        return $this->redirectToRoute('chaine_index');
    }
}
