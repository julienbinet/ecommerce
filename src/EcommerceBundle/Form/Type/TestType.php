<?php

namespace EcommerceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class TestType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('email', EmailType::class , array('mapped' => false)); // pout ne pas faire lien avec objet
                //->add('tg', TextType::class);
    }

    public function getName() {
        return "ecommerce_ecommercebundle_test";
    }

}
