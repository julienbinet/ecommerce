<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PanierController extends Controller {

    /**
     * @Route("/panier", name="panier")
     */
    public function panierAction() {
        return $this->render('EcommerceBundle:Default:panier/layout/panier.html.twig');
    }

    /**
     * @Route("/livraison" , name="livraison")
     */
    public function livraisonAction() {
        return $this->render('EcommerceBundle:Default:panier/layout/livraison.html.twig');
    }

    /**
     * @Route("/validation" , name="validation")
     */
    public function validationAction() {
        return $this->render('EcommerceBundle:Default:panier/layout/validation.html.twig');
    }

}
