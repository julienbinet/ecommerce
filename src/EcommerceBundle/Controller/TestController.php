<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use EcommerceBundle\Entity\Produits;

/**
 * @Route("/test")
 */

class TestController extends Controller {

    /**
     * @Route("/ajout", name="test_ajout")
     */
    public function ajoutAction() {
        
        $em = $this->getDoctrine()->getManager();
        
        $produit = new Produits();
        $produit->setCategorie("Légume");
        $produit->setDescription("Une belle tomate");
        $produit->setDisponible("1");
        $produit->setImage("http://camerdish.e-monsite.com/medias/images/tomate-1.jpg");
        $produit->setNom("Tomate");
        $produit->setPrix("0.99");
        $produit->setTva("19.6");
        
        $em->persist($produit);
        $em->flush();
        die("Produit ajouté");
        return $this->render('EcommerceBundle:Default:test.html.twig');
    }

   

}
