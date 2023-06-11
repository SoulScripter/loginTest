<?php
declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
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
                ],
                )
            ->add(
                child: 'password', 
                type: PasswordType::class,
                options: [
                    'label' => 'Password', 
                    'required' => true,
                ],
                )
            ->add(
                child: 'passwordRepeat', 
                type:PasswordType::class,
                options: [
                    'label' => 'Passwort wiederholen',
                    'required' => true,
                ],
                )
            ->add(
                child: 'email', 
                type: TextType::class,
                options: [
                    'label' => 'Email', 
                    'required' => true,
                ],
                )
            ->add(
                child: 'firstName', 
                type: TextType::class,
                options: [
                    'label' => 'Vorname', 
                    'required' => true,
                ],
                )
            ->add(
                child: 'lastName', 
                type: TextType::class,
                options: [
                    'label' => 'Nachname', 
                    'required' => true,
                ],
                )
            ->add(
                child: 'dateOfBirth', 
                type: BirthdayType::class,
                options: [
                    'input' => 'datetime_immutable',
                    'label' => 'Geburtsdatum', 
                    'required' => true, 
                ],
                )
            ->add(
                child: 'nationality', 
                type: TextType::class,
                options: [
                    'label' => 'Staatsangehörigkeit', 
                    'required' => true],
                )
            ->add(
                child: 'phone', 
                type: NumberType::class,
                options: [
                    'label' => 'Telefonnummer', 
                    'required' => true],
                )
            ->add(
                child: 'street', 
                type: TextType::class,
                options: [
                    'label' => 'Straße', 
                    'required' => true],
                )
            ->add(
                child: 'houseNumber', 
                type: TextType::class,
                options: [
                    'label' => 'Hausnummer', 
                    'required' => true],
                )
            ->add(
                child: 'city', 
                type: TextType::class,
                options: [
                    'label' => 'Stadt', 
                    'required' => true],
                )
            ->add(
                child: 'postalCode', 
                type: NumberType::class,
                options: [
                    'label' => 'Postleitzahl', 
                    'required' => true],
                )
            ->add(
                child: 'save', 
                type: SubmitType::class,
                options: ['label' => 'Registrieren'],
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
    }
}
