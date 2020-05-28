<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('slug')
            ->add('titre')
            ->add('description')
            ->add('prixTTC')
            ->add('poids')
            ->add('couleur',ChoiceType::class,[
                'choices'=>["Blanc"=>1,
                    "Bleu"=>2,
                    "Noir"=>3,
                    "Rouge"=>4]
            ])
            ->add('dateCreation',DateType::class,[
                'widget'=> 'single_text',
            ])
            ->add('actif')
            ->add('marque', EntityType::class,[
                'choice_label'=> 'nom',
                'class' => marque::class
            ])
            ->add('imagefile', FileType::class,[
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
