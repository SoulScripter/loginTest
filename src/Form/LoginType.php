<?php
declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                child: 'username',
                type: TextType::class,
                options: [
                    'label' => 'Username',
                    'required' => true,
                ]
            )
            ->add(
                child: 'password',
                type: PasswordType::class,
                options: [
                    'label' => 'Password',
                    'required' => true,
                ]
            )
            ->add(
                child: 'save',
                type: SubmitType::class,
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
    }
}