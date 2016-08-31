<?php

namespace ChamadosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SacType extends AbstractType
{
  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('numero_pedido')
      ->add('nome_cliente')
      ->add('email')
      ->add('titulo')
      ->add('obs')
      ->add('isActive')
      // ->add('form_enctype', 'text/data')
    ;
  }

  /**
   * @param OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'ChamadosBundle\Entity\Sac'
    ));
  }
}