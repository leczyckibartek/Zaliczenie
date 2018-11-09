<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-10-29
 * Time: 23:57
 */

namespace App\Form;


use App\Entity\Expirience;


use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpirienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nameOfJob',TextType::class,array('label'=>'Nazwa Stanowiska'))
            ->add('company',TextType::class,array('label'=>'Nazwa firmy'));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Expirience::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'ExpirienceType';
    }
}