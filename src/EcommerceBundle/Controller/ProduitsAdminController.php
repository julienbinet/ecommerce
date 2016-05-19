<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use EcommerceBundle\Entity\Produits;
use EcommerceBundle\Form\ProduitsType;

/**
 * Produits controller.
 *
 * @Route("/admin/produits")
 */
class ProduitsAdminController extends Controller {

    /**
     * Lists all Produits entities.
     *
     * @Route("/", name="admin_produits_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('EcommerceBundle:Produits')->findBy(array(), array('nom' => 'ASC'));

        return $this->render('EcommerceBundle:Administration:produits/layout/index.html.twig', array(
                    'produits' => $produits,
        ));
    }

    /**
     * Creates a new Produits entity.
     *
     * @Route("/new", name="admin_produits_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $produit = new Produits();
        $form = $this->createForm('EcommerceBundle\Form\ProduitsType', $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('admin_produits_show', array('id' => $produit->getId()));
        }

        return $this->render('EcommerceBundle:Administration:produits/layout/new.html.twig', array(
                    'produit' => $produit,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Produits entity.
     *
     * @Route("/{id}", name="admin_produits_show")
     * @Method("GET")
     */
    public function showAction(Produits $produit) {
        $deleteForm = $this->createDeleteForm($produit);

        return $this->render('EcommerceBundle:Administration:produits/layout/show.html.twig', array(
                    'produit' => $produit,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Produits entity.
     *
     * @Route("/{id}/edit", name="admin_produits_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Produits $produit) {
        $deleteForm = $this->createDeleteForm($produit);
        $editForm = $this->createForm('EcommerceBundle\Form\ProduitsType', $produit);
        $editForm->handleRequest($request);



        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('admin_produits_edit', array('id' => $produit->getId()));
        }

        return $this->render('EcommerceBundle:Administration:produits/layout/edit.html.twig', array(
                    'produit' => $produit,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Produits entity.
     *
     * @Route("/{id}", name="admin_produits_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Produits $produit) {
        $form = $this->createDeleteForm($produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produit);
            $em->flush();
        }

        return $this->redirectToRoute('admin_produits_index');
    }

    /**
     * Creates a form to delete a Produits entity.
     *
     * @param Produits $produit The Produits entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produits $produit) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_produits_delete', array('id' => $produit->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
