<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-10-17
 * Time: 19:26
 */



namespace App\Form;







use App\Entity\CvMain;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lname',TextType::class,array('label' => 'Imie'))
            ->add('fname',TextType::class,array('label' => 'Nazwisko'))
            ->add('dateOfBirth',DateType::class,array('label' => 'Data urodzenia'))
            ->add('sex',ChoiceType::class,array(
                'label' => 'Płeć',
                'choices' => array(
                    'Mężczyzna'=>'m',
                    'Kobieta'=>'w'
    )
            ))
            ->add('address',TextType::class,array('label' => 'Adres'))
            ->add('photo',TextType::class,array('label' => 'Zdjęcie'))
            ->add('phone',TextType::class,array('label' => 'telefon'))
            ->add('expiriences', CollectionType::class, array(
                'entry_type' => ExpirienceType::class,
                'entry_options' => array('label' => 'Doświadczenie'),
                'label' => false,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'prototype' => true,
                'attr' => array(
                    'class' => 'expiriences',
                ),
            ))
            ->add('schools', CollectionType::class, array(
                'entry_type' => SchoolType::class,
                'entry_options' => array('label' => 'Edukacja'),
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


