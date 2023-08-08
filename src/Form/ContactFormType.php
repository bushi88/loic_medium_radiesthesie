<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactFormType extends AbstractType
{
    public function __construct(
        private TranslatorInterface $translator
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'required' => true,
                'label' => $this->translator->trans('Prénom'),
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => $this->translator->trans('Veuillez saisir votre prénom'),
                    ]),
                ],
            ])
            ->add('lastname', TextType::class, [
                'required' => true,
                'label' => $this->translator->trans('Nom'),
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => $this->translator->trans('Veuillez saisir votre nom'),
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => $this->translator->trans('Email'),
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => $this->translator->trans('Veuillez saisir votre email'),
                    ]),
                    new Email([
                        'message' => $this->translator->trans('Veuillez saisir un email valide'),
                    ]),
                ],
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'label' => $this->translator->trans('Votre téléphone'),
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('object', ChoiceType::class, [
                'required' => true,
                'label' => $this->translator->trans('Objet de votre demande'),
                'attr' => [
                    'class' => 'form-control'
                ],
                'choices' => [
                    $this->translator->trans('Sélectionnez un sujet') => '',
                    $this->translator->trans('Demande d\'information')  => 'demande_information',
                    $this->translator->trans('Demande de rappel')  => 'demande_rappel',
                    $this->translator->trans('Demande de rendez-vous')  => 'demande_rdv',
                    $this->translator->trans('Autre')  => 'autre',
                ],
            ])
            ->add('message', TextareaType::class, [
                'required' => true,
                'label' => $this->translator->trans('Votre message'),
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 4,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}