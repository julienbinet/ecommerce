<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class PanierController extends Controller {

    public function menuAction(Request $request) {

        $session = $request->getSession();
        if (!$session->has(('panier')))
            $articles = 0;
        else
            $articles = count($session->get('panier'));

        return $this->render('EcommerceBundle:Default:panier/modulesUsed/panier.html.twig', array('articles' => $articles));
    }

    /**
     * @Route("/ajouter/{id}", name="ajouter")
     */
    public function ajouterAction($id, Request $request) {

        $session = $request->getSession();

        if (!$session->has(('panier')))
            $session->set('panier', array());
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier)) {
            if ($request->query->get('qte') != null) {
                $panier[$id] = $request->query->get('qte');
                $session->getFlashBag()->add('success', 'Quantité modifié avec succès');
            }
        } else {
            if ($request->query->get('qte') != null)
                $panier[$id] = $request->query->get('qte');
            else
                $panier[$id] = 1;

            $session->getFlashBag()->add('success', 'Article ajouté avec succès');
        }

        $session->set('panier', $panier);

        return $this->redirect($this->generateUrl('panier'));
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer")
     */
    public function supprimerAction($id, Request $request) {

        $session = $request->getSession();
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier)) {
            unset($panier[$id]);
            $session->set('panier', $panier);
            $session->getFlashBag()->add('success', 'Article supprimé avec succès');
        }

        return $this->redirect($this->generateUrl('panier'));
    }

    /**
     * @Route("/panier", name="panier")
     */
    public function panierAction(Request $request) {

        $session = $request->getSession();
        
//        $session->remove('panier');
//        die();

        if (!$session->has(('panier')))
            $session->set('panier', array());

        $panier = $session->get('panier');

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EcommerceBundle:Produits')->findArray(array_keys($panier));

        return $this->render('EcommerceBundle:Default:panier/layout/panier.html.twig', array('produits' => $produits, 'panier' => $panier));
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
