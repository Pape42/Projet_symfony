<?php

namespace App\Form;

use App\Entity\Livre;
use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

// Formulaire utilisé pour créer un livre
class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // Champ pour le titre du livre
            ->add('titre', TextType::class)

            // Champ pour choisir l'auteur du livre
            ->add('auteur', EntityType::class, [
                'class' => Auteur::class,
                'choice_label' => 'nom'
            ]);
    }
}
