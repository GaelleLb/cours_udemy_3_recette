<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAlimentController extends AbstractController
{
    /**
     * @Route("/admin/aliment", name="admin_aliment")
     */
    public function adminAliments(AlimentRepository $repo)
    {
        $aliments = $repo->findAll();
        return $this->render('admin/admin_aliment/adminAliment.html.twig', [
            'aliments' => $aliments
        ]);
    }

    /**
     * @Route("/admin/aliment/ajouter", name="admin_aliment_ajouter")
     * @Route("/admin/aliment/{id}", name="admin_aliment_modifier", methods="GET|POST")
     */
    public function AjouterEtModifier(Aliment $aliment = null, Request $request, EntityManagerInterface $manager)
    {
        if(!$aliment) {
            $aliment = new Aliment();
        }

        $form = $this->createForm(AlimentType::class, $aliment);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $modif = $aliment->getId() !== null;
            $manager->persist($aliment);
            $manager->flush();
            $this->addflash("success", ($modif) ? "La Modification a bien été effectué" : "L'ajout a bien été effectué");
            return $this->redirectToRoute("admin_aliment");
        }

        return $this->render('admin/admin_aliment/modifierAliment.html.twig', [
            'aliment' => $aliment,
            "form" =>$form->createView(),
            "isModification" => $aliment->getId() !== null
        ]);
    }


    /**
     * @Route("/admin/aliment/{id}", name="admin_aliment_supprimer", methods="delete")
     */
    public function surppimer(Aliment $aliment, Request $request, EntityManagerInterface $manager)
    {
        if($this->isCsrfTokenValid("SUP" . $aliment->getId(), $request->get('_token'))) {
            $manager->remove($aliment);
            $manager->flush();
            $this->addflash("success", "L'aliment a bien été supprimé'");
            return $this->redirectToRoute("admin_aliment");
        }

    }
}
