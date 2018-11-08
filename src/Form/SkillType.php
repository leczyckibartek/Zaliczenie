<?php
/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-10-29
 * Time: 23:57
 */

namespace App\Form;


use App\Entity\Skill;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',TextType::class,array('label'=>'Nazwa technologii'))
                ->add('value',RangeType::class,array('label'=>'Poziom'));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Skill::class,
        ));
    }
}