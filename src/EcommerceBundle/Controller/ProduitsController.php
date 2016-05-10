<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use EcommerceBundle\Form\Type\RechercheType;
use EcommerceBundle\Entity\Categories;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ProduitsController extends Controller {

    /**
     * @Route("/", name="produit")
     * 
     * @Route("/categorie/{id}", name="categorie_produits")
     * @ParamConverter("Categories", class="EcommerceBundle\Entity\Categories", isOptional="true")
     * 
     */
    public function produitsAction(Request $request, Categories $idCategorie = null) {

        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();

        if ($idCategorie != null)
            $findProduits = $em->getRepository('EcommerceBundle:Produits')->byCategorie($idCategorie);
        else
            $findProduits = $em->getRepository('EcommerceBundle:Produits')->findBy(array("disponible" => 1));

        if ($session->has(('panier')))
            $panier = $session->get('panier');
        else
            $panier = false;


        $produits = $this->get('knp_paginator')->paginate(
                $findProduits,
                $request->query->getInt('page', 1)/* page number */,
                3/* limit per page */
        );

        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits,
                    'panier' => $panier));
    }

    /**
     * @Route("/produit/{id}", name="presentation")
     */
    public function presentationAction($id, Request $request) {

        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('EcommerceBundle:Produits')->find($id);

        if (!$produit)
            throw $this->createNotFoundException("Le produit n'existe pas");

        if ($session->has(('panier')))
            $panier = $session->get('panier');
        else
            $panier = false;

        return $this->render('EcommerceBundle:Default:produits/layout/presentation.html.twig', array('produit' => $produit,
                    'panier' => $panier));
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
        } else {
            throw $this->createNotFoundException("La page n'existe pas");
        }



        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produit));
    }

}
