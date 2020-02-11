<?php

namespace App\Form;

use App\Entity\Newsletter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsletterType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    // On déclare l'ensemble des champs qui seront présents dans le formulaire
    $builder
      ->add('email', EmailType::class)
      ->add('Enregistrer', SubmitType::class);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    // On lie ce formulaire à l'entité Newsletter
    // Newsletter::class retourne le FQCN de la classe Newsletter
    $resolver->setDefaults([
      'data_class' => Newsletter::class,
    ]);
  }
}
