<?php
declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class CityForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Add a text field for "name"
        $builder
            ->add('city', TextType::class, [
                'label' => 'City name',
                'attr' => ['placeholder' => 'Enter city name'],
            ])
            // Add a submit button
            ->add('submit', SubmitType::class, [
                'label' => 'Submit'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // Set the default data class if needed
        $resolver->setDefaults([
            'data_class' => null,  // This can be a specific entity if you have one
        ]);
    }
}