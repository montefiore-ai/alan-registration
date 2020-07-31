<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class AccessRequestApproveFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userGroup', ChoiceType::class, [
                'choices' => [
                    'Select a user group' => [
                        'Users' => 'users', // default
                        'Students' => 'students',
                        'Priority Users' => 'priority-users'
                    ]
                ],
            ])
            ->add('approve', SubmitType::class);
    }

}