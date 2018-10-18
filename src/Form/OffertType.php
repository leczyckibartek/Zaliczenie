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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class OffertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,array('label' => 'Nazwa Stanowiska'))
            ->add('content',TextareaType::class,array('label' => 'Opis Stanowiska'))
            ->add('employer_id',IntegerType::class,array('label' => 'ID'))
            ->add('save', SubmitType::class)
        ;
    }
}