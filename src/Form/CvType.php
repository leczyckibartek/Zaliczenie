<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-10-17
 * Time: 19:26
 */



namespace App\Form;







use App\Entity\CvMain;


use App\Entity\SkillCv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lname',TextType::class,array('label' => false,))
            ->add('fname',TextType::class,array('label' => false))
            ->add('dateOfBirth',DateType::class,array('label' => false
            ,    'widget' => 'single_text',
                'required'=>true,
                'attr' => array(
                    'value' => "2018-01-01"
                )
            ))
            ->add('sex',ChoiceType::class,array(
                'label' => false,
                'choices' => array(
                    'Mężczyzna'=>'m',
                    'Kobieta'=>'w'
    )
            ))
            ->add('address',TextType::class,array('label' => false))
            ->add('photo',FileType::class,array('label' => false,'data_class'=>null))
            ->add('phone',TextType::class,array('label' => false))
            ->add('expiriences', CollectionType::class, array(
                'entry_type' => ExpirienceType::class,
                'entry_options' => array('label' => false),
                'label' => false,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'prototype' => true,
                'attr' => array(
                    'class' => 'expiriences',
                ),
            ))
            ->add('skillCvs', CollectionType::class, array(
                'entry_type' => SkillCvType::class,
                'entry_options' => array('label' => false),
                'label' => false,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'prototype' => true,
                'attr' => array(
                    'class' => 'skillCvs',
                )))
            ->add('schools', CollectionType::class, array(
                'entry_type' => SchoolType::class,
                'entry_options' => array('label' => false),
                'label' => false,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'prototype' => true,
                'attr' => array(
                    'class' => 'schools',
                ),
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CvMain::class,
        ));
    }



}


