<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Repository\AlimentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlimentController extends AbstractController
{
    
    /**
     * @Route("/", name="aliments")
     */
    public function aliments(AlimentRepository $repo)
    {
        $aliments = $repo->findAll();
        return $this->render('aliment/aliments.html.twig', [
            'aliments' => $aliments,
            'isCalorie' =>false,
            'isGlucide' => false
        ]);
    }

    /**
     * @Route("/aliment", name="aliment")
     */
    public function aliment(Aliment $aliment)
    {
        return $this->render('aliment/aliment.html.twig', [
            'aliment' => $aliment
        ]);
    }

    /**
     * @Route("/aliments/calories/{calorie}", name="alimentsParCalorie")
     */
    public function alimentsParCalorie(AlimentRepository $repo, $calorie)
    {
        $aliments = $repo->getAlimentsParPropriete('calorie', '<', $calorie);
        return $this->render('aliment/aliments.html.twig', [
            'aliments' => $aliments,
            'isCalorie' => true,
            'isGlucide' => false


        ]);
    }

    /**
     * @Route("/aliments/glucide/{glucide}", name="alimentsParGlucide")
     */
    public function alimentsAvecMoinsGlucide(AlimentRepository $repo, $glucide)
    {
        $aliments = $repo->getAlimentsParPropriete('glucide', '<', $glucide);
        return $this->render('aliment/aliments.html.twig', [
            'aliments' => $aliments,
            'isCalorie' => false,
            'isGlucide' => true
        ]);
    }
}
