<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');

        $marque1 = new Marque();
        $marque1->setNom("Apple");
        $manager->persist($marque1);
        $marque2 = new Marque();
        $marque2->setNom("Samsung");
        $manager->persist($marque2);
        $marque3 = new Marque();
        $marque3->setNom("Microsoft");
        $manager->persist($marque3);

        $marqueArray = [$marque1,$marque2,$marque3];

        for ($i=0; $i<100; $i++){
            $produit = new Produit();
            $produit->setTitre($faker->randomElement(['Lave vaisselle','Grille Pain', 'Ventilateur',
                'Tablette', 'Telephone','Lave linge', 'Ordinateur', 'Robot menager']))
            ->setCouleur($faker->numberBetween(1,10))
            ->setDescription($faker->sentence(20,true))
            ->setPoids($faker->randomFloat(2,2,500))
            ->setPrixTTC($faker->randomNumber(4))
            ->setActif($faker->randomElement([true,false]))
            ->setStockQte($faker->randomNumber(2))
            ->setMarque($marqueArray[0]);


            $manager->persist($produit);
        }
        $manager->flush();
    }
}
