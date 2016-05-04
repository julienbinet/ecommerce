<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use EcommerceBundle\Form\Type\RechercheType;
use Symfony\Component\HttpFoundation\Request;

class ProduitsController extends Controller {

    /**
     * @Route("/", name="produit")
     */
    public function produitsAction() {
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EcommerceBundle:Produits')->findBy(array("disponible" => 1));

        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits));
    }

    /**
     * @Route("/produit/{id}", name="presentation")
     */
    public function presentationAction($id) {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('EcommerceBundle:Produits')->find($id);

        if(!$produit) throw  $this->createNotFoundException("Le produit n'existe pas");
        return $this->render('EcommerceBundle:Default:produits/layout/presentation.html.twig', array('produit' => $produit));
    }

    /**
     * @Route("/categorie/{id}", name="categorie_produits")
     */
    public function categorieAction($id) {

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EcommerceBundle:Produits')->byCategorie($id);

        $categorie = $em->getRepository('EcommerceBundle:Categories')->find($id);
        if(!$categorie) throw  $this->createNotFoundException("La catégorie n'existe pas");
        
        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits));
    }

    public function rechercheAction() {

        $form = $this->createForm(RechercheType::class, new RechercheType());

        return $this->render('EcommerceBundle:Default:recherche/modulesUsed/recherche.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/recherche", name="rechercheProduits")
     */
    public function rechercheTraitementAction(Request $request) {


        $form = $this->createForm(RechercheType::class, new RechercheType());

        if ($request->getMethod() == "POST") {

            $form->handleRequest($request);
            $chaine = $form['recherche']->getData();
            
            $em = $this->getDoctrine()->getManager();
            $produit = $em->getRepository('EcommerceBundle:Produits')->recherche($chaine);
        }else{
            throw  $this->createNotFoundException("La page n'existe pas");
        }



        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produit));
    }

}
