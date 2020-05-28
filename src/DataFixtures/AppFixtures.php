<?php

namespace App\DataFixtures;

use App\Entity\Magasin;
use App\Entity\Marque;
use App\Entity\Produit;
use App\Entity\ProduitsMagasins;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');

        $userAdmin = new User();
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setEmail('admin@admin.fr');
        $encoded = $this->encoder->encodePassword($userAdmin, '123');
        $userAdmin->setPassword($encoded);
        $manager->persist($userAdmin);

        $marque1 = new Marque();
        $marque1->setNom("Apple");
        $manager->persist($marque1);
        $marque2 = new Marque();
        $marque2->setNom("Samsung");
        $manager->persist($marque2);
        $marque3 = new Marque();
        $marque3->setNom("Microsoft");
        $manager->persist($marque3);

        $magasin1 = new Magasin();
        $magasin1->setNom("IKEA");
        $manager->persist($magasin1);
        $magasin2 = new Magasin();
        $magasin2->setNom("Carrefour");
        $manager->persist($magasin2);
        $magasin3 = new Magasin();
        $magasin3->setNom("Leclerc");
        $manager->persist($magasin3);

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

            $produitsMagasins1 = new ProduitsMagasins();
            $produitsMagasins1->setProduit($produit);
            $produitsMagasins1->setMagasin($magasin1);
            $manager->persist($produitsMagasins1);
        }
        $manager->flush();
    }
}
