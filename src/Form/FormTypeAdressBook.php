<?php

namespace App\Form;

use App\Entity\AddressBooks;
use App\Entity\City;
use App\Entity\Country;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;



class FormTypeAdressBook extends AbstractType
{

    public function  buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('save', SubmitType::class, ['label' => 'submit'])
            ->add('firstname',TextType::class,[
                'label' => 'First Name',
                'attr' => ['class' => 'form-control'],
                'mapped' => true,'constraints' => [
                new NotBlank(['message' => 'Firstname cannot be empty']),
                new Length([
                    'min' => '3',
                    'max'=> '30',
                    'minMessage' => ' Firstname must be more than  {{ limit }} char ',
                    'maxMessage' => ' Firstname must be less than  {{ limit }} char '
                ])
            ]])
            ->add('lastname',TextType::class,['label' => 'Last Name','attr' => ['class' => 'form-control'],'mapped' => true,'constraints' => [
                new NotBlank(['message' => 'Lastname cannot be empty']),
                new Length([
                    'min' => '3',
                    'max'=> '30',
                    'minMessage' => ' Lastname must be more than  {{ limit }} char ',
                    'maxMessage' => ' Lastname must be less than  {{ limit }} char '
                ])
            ]])
            ->add('street_number',NumberType::class,['label' => 'Street Number','attr' => ['class' => 'form-control'],'mapped' => true,'constraints' => [
                new NotBlank(['message' => 'Street Number cannot be empty']),
                new Length([
                    'min' => '1',
                    'max'=> '5',
                    'minMessage' => ' Street Number must be more than  {{ limit }} number ',
                    'maxMessage' => ' Street Number must be less than  {{ limit }} number '
                ])
            ]])
            ->add('zip',NumberType::class,['label' => 'Zip','attr' => ['class' => 'form-control'],'mapped' => true,'constraints' => [
                new NotBlank(['message' => 'zip code cannot be empty']),
                new Length([
                    'min' => '3',
                    'minMessage' => 'phonenumber must be more than  {{ limit }} number'
                ])
            ]])
            ->add('phonenumber',NumberType::class,['label' => 'Phone Number','attr' => ['class' => 'form-control'],'mapped' => true,'constraints' => [
                new NotBlank(['message' => 'This cannot be empty']),
                new Length([
                    'min' => '10',
                    'max' => '12',
                    'minMessage' => ' phonenumber must be more than  {{ limit }} number ',
                    'maxMessage' => ' phonenumber must be less than  {{ limit }} number '
                ])
            ]])
            ->add('birthday',DateType::class,[ 'widget' => 'single_text','label' => 'Birthday','attr' => ['class' => 'form-control'],'mapped' => true,'constraints' => [
                new NotBlank(['message' => 'This cannot be empty'])
            ]])
            ->add('email',TextType::class,['label' => 'email','attr' => ['class' => 'form-control'],'mapped' => true,'constraints' => [
                new NotBlank(['message' => 'This cannot be empty']),
                new Email(['message'=>'Email is not valid'])
            ]])
            ->add('city',EntityType::class, [
                'class' => city::class,
                "required" => false,
                'choice_label' => "getCityName",'constraints' => [
                    new NotBlank(['message'=>'please select city'])
                ]
            ])
            ->add('country',EntityType::class, [
                'class' => Country::class,
                "required" => false,
                'choice_label' => 'getCountryName','constraints' => [
                    new NotBlank(['message'=>'please select Country'])
                ]
            ])
            ->getForm();

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddressBooks::class,
        ]);
    }

}
