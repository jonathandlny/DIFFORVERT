<?php

namespace App\Controller;

use App\Entity\Chaines;
use App\Entity\Lignes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LigneController extends AbstractController
{
    /**
     * @Route("/chaines/lignes", name="ligne")
     */
    public function index()
    {
        $allLignes = $this->getDoctrine()->getRepository(Lignes::class);
        $lignes = $allLignes->findAll();

        return $this->render('difforvert/lignes/ligne.html.twig', [
            'lignes' => $lignes,
        ]);
    }
}
