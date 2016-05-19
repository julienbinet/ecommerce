<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UtilisateursAdressesType extends AbstractType {
//    private $em;
//
//    public function __construct($em) {
//        $this->em = $em;
//    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom', null, array("attr" => array('class' => "form-control")))
                ->add('prenom', null, array("attr" => array('class' => "form-control")))
                ->add('telephone', null, array("attr" => array('class' => "form-control")))
                ->add('adresse', null, array("attr" => array('class' => "form-control")))
                ->add('cp', null, array("attr" => array('class' => "cp form-control", "maxlength" => 5)))
                ->add('ville', ChoiceType::class, array(
                    "attr" => array('class' => "ville form-control")))
                ->add('pays', null, array("attr" => array('class' => "form-control")))
                ->add('complement', null, array('required' => false, "attr" => array('class' => "form-control")))
        ;

        $city = function (FormInterface $form, $cp) {

            $formOptions = array(
                'class' => 'EcommerceBundle\Entity\Villes',
                "attr" => array('class' => "ville form-control"),
                "choice_value" => "villeNom",
                'data_class' => 'EcommerceBundle\Entity\Villes',
                'query_builder' => function (EntityRepository $er) use($cp) {
            $result = $er->createQueryBuilder('u')
                    ->where('u.villeCodePostal = :cp')
                    ->setParameter('cp', $cp)
                    ->orderBy('u.villeNom', 'ASC');

            return $result;
        },
            );

            $form->add('ville', EntityType::class, $formOptions);
        };

        $builder->get('cp')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use ($city) {
            /* on récuperer le form et la donnée concernant le code postal */
            $form = $event->getForm()->getParent();
            $cp = $event->getForm()->getData();

            $city($form, $cp);
        });
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'EcommerceBundle\Entity\UtilisateursAdresses'
        ));
    }

}
