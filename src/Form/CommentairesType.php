<?php

namespace App\Form;

use App\Entity\Recettes;
use App\Entity\Note;
use App\Entity\Commentaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CommentairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomRecette')
            ->add('notes', EntityType::class, [
                'class' => Note::class,
                'choice_label' => 'note'
            ])
            ->add('commentaires', EntityType::class, [
                'class' => Commentaires::class,
                'choice_label' => 'pseudo'
            ])
            ->add('commentaires', EntityType::class, [
                'class' => Commentaires::class,
                'choice_label' => 'createdAt'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recettes::class,
        ]);
    }
}
