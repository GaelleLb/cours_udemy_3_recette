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
            'aliments' => $aliments
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
}
