<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProduitsController extends Controller
{
    /**
     * @Route("/produit", name="produit")
     */
    public function produitsAction()
    {
        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig');
    }
    
        /**
     * @Route("/", name="presentation")
     */
    public function presentationAction()
    {
        return $this->render('EcommerceBundle:Default:produits/layout/presentation.html.twig');
    }
    
    
}
