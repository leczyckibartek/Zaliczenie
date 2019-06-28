<?php

/**
 * Created by PhpStorm.
 * User: Bartek1
 * Date: 2018-10-29
 * Time: 23:57
 */

namespace App\Form;


use App\Entity\Answer;
use App\Entity\AnswerTask;

use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('taskId', EntityType::class, array(
            'label'=>false,
            'class' => Task::class,
            // uses the User.username property as the visible option string
            'choice_label' => 'title',
//            'choice_value' => 'id',
            'mapped'=>false,
            // used to render a select box, check boxes or radios
//             'multiple' => true,
            // 'expanded' => true,
        ));



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Answer::class,
        ));
    }

}