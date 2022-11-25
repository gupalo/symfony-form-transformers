<?php

namespace Gupalo\SymfonyFormTransformers\FormType;

use Gupalo\SymfonyFormTransformers\Entity\Tsv;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TsvType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tsv', TextareaType::class, [
                'label' => 'TSV',
                'required' => false,
                'attr' => [
                    'autofocus' => true,
                    'rows' => 20,
                    'style' => 'font-family: Consolas, "Courier New", monospaced; font-size: 13px',
                    'wrap' => 'off',
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tsv::class,
        ]);
    }
}
