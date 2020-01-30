<?php

namespace App\Controller;

use App\Entity\Lignes;
use DateTimeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;


class ImportFPController extends AbstractController
{
    /**
     * @Route("/importFP", name="importFP")
     */
    public function index(Request $request, DateTimeInterface $dateTime)
    {
        $form = $this->createFormBuilder();
        $form->setMethod('POST');
        $form->add('importFP', FileType::class,[
            'label' => 'Fiche de Production',
            'mapped' => false,
        ]);
        $form->add('ajouter', SubmitType::class);

        $form = $form->getForm();
        $form = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['importFP']->getData();
            $file->move($this->getParameter('csv_directory'), $file->getClientOriginalName());
            $fileDirectory = $this->getParameter('csv_directory') . "/" . $file->getClientOriginalName();

            $i = 0;

            $fileCSV = fopen($fileDirectory, 'r');
            while (($row = fgetcsv($fileCSV, '1024', ";"))) {
                $tableau[] = $row;
                $data[] = explode(";", $tableau[$i][0]);
                $enlevement = $dateTime->format('Y-m-d');

                $ligne = new Lignes();

                $ligne->setNbrPerson($data[$i][0]);
                $ligne->setPickingDeco(2);
                $ligne->setReference($data[$i][1]);
                $ligne->setTotalP($data[$i][2]);
                $ligne->setClient($data[$i][3]);
                $ligne->setEnlevement($enlevement);
                $ligne->setEtiquette($data[$i][5]);
                $ligne->setHauteurCarton($data[$i][6]);
                $ligne->setNombreCarton($data[$i][7]);
                $ligne->setNombreCartonPalettes($data[$i][8]);
                $ligne->setTotalPalette($data[$i][9]);
                $ligne->setNbrEtage($data[$i][10]);
                $ligne->setEtageChariot($data[$i][11]);
                $ligne->setTotalChariot($data[$i][12]);
                $ligne->setDetailAProduire($data[$i][13]);
                $ligne->setTempsTotalHeures($data[$i][14]);
                $ligne->setTempsPaletteRollsMinutes($data[$i][15]);
                $ligne->setHeureDebut("");
                $ligne->setHeureFin("");
                $ligne->setTempsRealise("");
                $ligne->setVerifTemps("");
                $ligne->setPickingProduit("");
                $ligne->setVisaResponsable("");

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($ligne);
                $entityManager->flush();
                $i++;
            }


            return $this->render('difforvert/lignes/ligne.html.twig', [
                'data' => $data,
            ]);
        }

        return $this->render('difforvert/importFP.html.twig', [
            'form' => $form->createView(),
        ]);    }
}
?>