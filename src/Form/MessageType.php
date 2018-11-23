<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-10-29
 * Time: 23:57
 */

namespace App\Form;




use App\Entity\Message;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('receiver',TextType::class,array('label'=>'Nazwa'))
            ->add('content',TextType::class,array('label'=>'Treść'))
            ->add('subject',TextType::class,array('label'=>'Temat'))
;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Message::class,
        ));
    }


}