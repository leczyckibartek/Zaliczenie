<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-10-29
 * Time: 23:57
 */

namespace App\Form;


use App\Entity\Expirience;


use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvatarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('avatar',FileType::class,array('label'=>'Zmien avatar','data_class'=>null ));


    }




}