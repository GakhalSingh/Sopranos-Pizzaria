<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OrderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount')
            ->add('size', ChoiceType::class, [
                'choices'  => [
                    'Klein' => 1,
                    'Medium' => 2,
                    'Groot' => 3,
                    'Extra Groot' => 4,
                ],])
        ;
    }

}