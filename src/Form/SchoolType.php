<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-10-29
 * Time: 23:57
 */

namespace App\Form;


use App\Entity\School;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SchoolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',TextType::class,array('label'=>'Nazwa szkoły'))
            ->add('title',TextType::class,array('label'=>'Wykształcenie'))
            ->add('start',DateType::class,array('label'=>'Data rozpoczęcia'))
            ->add('finish',DateType::class,array('label'=>'Data ukończenia'));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => School::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'SchoolType';
    }
}