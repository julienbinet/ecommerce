<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use EcommerceBundle\Form\UtilisateursAdressesType;
use EcommerceBundle\Entity\UtilisateursAdresses;

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
    public function livraisonAction(Request $request) {
        
 $em = $this->getDoctrine()->getManager();
 
        $utilisateur = $this->container->get('security.token_storage')->getToken()->getUser();
        $entity = new UtilisateursAdresses();
        $form = $this->createForm(UtilisateursAdressesType::class, $entity);

        if ($request->getMethod() == "POST") {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $entity->setUtilisateur($utilisateur);
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('livraison'));
            }
        }

        return $this->render('EcommerceBundle:Default:panier/layout/livraison.html.twig', array('utilisateur' => $utilisateur,
                    'form' => $form->createView()));
    }

    /**
     * @Route("/livraison/adresse/suppresion/{id}" , name="livraisonAdresseSuppression")
     */
    public function adresseSuppressionAction($id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EcommerceBundle:UtilisateursAdresses')->find($id);

        if ($this->container->get('security.token_storage')->getToken()->getUser() != $entity->getUtilisateur() || !$entity)
            return $this->redirect($this->generateUrl('livraison'));

        $em->remove($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('livraison'));
    }

    public function setLivraisonOnSession(Request $request) {
        $session = $request->getSession();

        if ($session->has('adresse'))
            $session->set('adresse', array());
        $adresse = $session->get('adresse');

        if ($request->request->get('livraison') != null && $request->request->get('facturation') != null) {
            $adresse['livraison'] = $request->request->get('livraison');
            $adresse['facturation'] = $request->request->get('facturation');
        } else {
            return $this->redirect($this->generateUrl('validation'));
        }

        $session->set('adresse', $adresse);
        return $this->redirect($this->generateUrl('validation'));
    }

    /**
     * @Route("/validation" , name="validation")
     */
    public function validationAction(Request $request) {

        if ($request->getMethod() == "POST")
            $this->setLivraisonOnSession($request);

        $em = $this->getDoctrine()->getManager();

        /* On fait appelle à la méthode contenu dans CommandesController preparecommande() */
        $prepareCommande = $this->forward('EcommerceBundle:Commandes:prepareCommande');
        $commande = $em->getRepository('EcommerceBundle:Commandes')->find($prepareCommande->getContent());

        return $this->render('EcommerceBundle:Default:panier/layout/validation.html.twig', array(
                    "commande" => $commande,
                        )
        );
    }

}
