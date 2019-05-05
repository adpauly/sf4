<?php

namespace App\Form;

use App\Entity\Work;
use App\Entity\Author;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EditWorkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('realizationDate', DateType::class, [
                // 'placeholder' => [
                //     'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                // ],
            ])
            ->add('authors', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'firstname',
                'expanded' => true,
                'multiple' => true
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Work::class,
        ]);
    }
}
