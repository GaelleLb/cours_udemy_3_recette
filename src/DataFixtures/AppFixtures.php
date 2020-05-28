<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $a1 = new Aliment();
        $a1->setNom("Carotte")
            ->setCalorie(31)
            ->setPrix(1.80)
            ->setImage("carotte.png")
            ->setProteine(0.77)
            ->setGlucide(6.45)
            ->setLipide(0.26);
        $manager->persist($a1);

        $a2 = new Aliment();
        $a2->setNom("Patate")
            ->setCalorie(24)
            ->setPrix(1.80)
            ->setImage("patate.jpg")
            ->setProteine(0.61)
            ->setGlucide(4.12)
            ->setLipide(0.46);
        $manager->persist($a2);

        $a3 = new Aliment();
        $a3->setNom("Pomme")
            ->setCalorie(12)
            ->setPrix(1.80)
            ->setImage("pomme.png")
            ->setProteine(1.23)
            ->setGlucide(2.49)
            ->setLipide(0.08);
        $manager->persist($a3);

        $a4 = new Aliment();
        $a4->setNom("Tomate")
            ->setCalorie(11)
            ->setPrix(1.80)
            ->setImage("tomate.png")
            ->setProteine(0.94)
            ->setGlucide(5.49)
            ->setLipide(0.64);
        $manager->persist($a4);


        $manager->flush();
    }
}
