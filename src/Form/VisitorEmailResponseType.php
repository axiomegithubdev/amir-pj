<?php

namespace App\Form;

use App\Entity\VisitorEmailResponse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisitorEmailResponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject', TextType::class, [
                "label"     => "Sujet",
                "attr"      => [
                    "placeholder"   => "Objet de la réponse"
                ]
            ] )
            ->add('content', TextareaType::class, [
                "label"     => "Votre message",
                "attr"      => [
                    "placeholder"   => "Veuillez saisir votre message..."
                ]
            ])
            ->add('submit', SubmitType::class, [
                "label"     => "Envoyer la réponse",
                "attr"      => [
                    "class" => "btn btn-success"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VisitorEmailResponse::class,
        ]);
    }
}
