<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EcommerceBundle\Form\MediaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProduitsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, array('required' => false, "attr" => array('class' => "form-control")))
            ->add('description', null, array("attr" => array('class' => "form-control")))
            ->add('prix',null, array("attr" => array('class' => "form-control")))
            ->add('disponible', null, array("attr" => array('class' => "form-control")))
            ->add('image', MediaType::class)
            ->add('tva', null, array("attr" => array('class' => "form-control")))
            ->add('categorie', null, array("attr" => array('class' => "form-control")))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EcommerceBundle\Entity\Produits'
        ));
    }
}
