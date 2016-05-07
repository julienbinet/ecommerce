<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use EcommerceBundle\Form\Type\RechercheType;
use Symfony\Component\HttpFoundation\Request;

class ProduitsController extends Controller {

    /**
     * @Route("/categorie/{id}", name="categorie_produits")
     */
    public function categorieAction($id) {

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EcommerceBundle:Produits')->byCategorie($id);

        $categorie = $em->getRepository('EcommerceBundle:Categories')->find($id);
        if (!$categorie)
            throw $this->createNotFoundException("La catégorie n'existe pas");

        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits));
    }

    /**
     * @Route("/", name="produit")
     */
    public function produitsAction(Request $request) {

        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EcommerceBundle:Produits')->findBy(array("disponible" => 1));

        if ($session->has(('panier')))
            $panier = $session->get('panier');
        else
            $panier = false;

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
