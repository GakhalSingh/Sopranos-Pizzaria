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
                    'Klein' => 'Klein',
                    'Medium' => 'Medium',
                    'Groot' => 'Groot',
                    'Extra Groot' => 'Extra Groot',
                ],])
        ;
    }

}