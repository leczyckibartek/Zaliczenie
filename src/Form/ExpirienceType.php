<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-10-29
 * Time: 23:57
 */

namespace App\Form;


use App\Entity\Expirience;


use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpirienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameOfJob',TextType::class,array('label'=>'Nazwa Stanowiska' ,'empty_data'=>'',))
            ->add('company',TextType::class,array('label'=>'Nazwa firmy','empty_data'=>''))
            ->add('start',DateType::class,array('label'=>'Data rozpoczęcia', 'empty_data'=>'','widget' => 'single_text',  'attr' => array(
                'value' => "2018-01-01"
            )))
            ->add('finish',DateType::class,array('label'=>'Data ukończenia', 'empty_data'=>'','widget' => 'single_text',  'attr' => array(
                'value' => "2018-01-01"
            )));


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