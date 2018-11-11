<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-10-17
 * Time: 19:26
 */



namespace App\Form;







use App\Entity\Offert;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,array('label' => false))
            ->add('description',TextType::class,array('label' => false))
            ->add('content',TextareaType::class,array('label' => false))
            ->add('salaryMin',IntegerType::class,array('label' => false))
            ->add('salaryMax',IntegerType::class,array('label' => false))
            ->add('skill', CollectionType::class, array(
            'entry_type' => SkillType::class,
            'label' => false,
            'entry_options' => array('label' => false),
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'prototype' => true,
                'attr' => array(
                    'class' => 'skills',
                ),
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Offert::class,
        ));
    }



}


