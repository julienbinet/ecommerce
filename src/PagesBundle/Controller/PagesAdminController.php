<?php

namespace PagesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PagesBundle\Entity\Pages;
use PagesBundle\Form\PagesType;

/**
 * Pages controller.
 *
 * @Route("/admin/pages")
 */
class PagesAdminController extends Controller
{
    /**
     * Lists all Pages entities.
     *
     * @Route("/", name="admin_pages_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pages = $em->getRepository('PagesBundle:Pages')->findAll();

        return $this->render('PagesBundle:Administration:pages/layout/index.html.twig', array(
            'pages' => $pages,
        ));
    }

    /**
     * Creates a new Pages entity.
     *
     * @Route("/new", name="admin_pages_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $page = new Pages();
        $form = $this->createForm('PagesBundle\Form\PagesType', $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('admin_pages_show', array('id' => $page->getId()));
        }

        return $this->render('PagesBundle:Administration:pages/layout/new.html.twig', array(
            'page' => $page,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pages entity.
     *
     * @Route("/{id}", name="admin_pages_show")
     * @Method("GET")
     */
    public function showAction(Pages $page)
    {
        $deleteForm = $this->createDeleteForm($page);

        return $this->render('PagesBundle:Administration:pages/layout/show.html.twig', array(
            'page' => $page,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pages entity.
     *
     * @Route("/{id}/edit", name="admin_pages_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pages $page)
    {
        $deleteForm = $this->createDeleteForm($page);
        $editForm = $this->createForm('PagesBundle\Form\PagesType', $page);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('admin_pages_edit', array('id' => $page->getId()));
        }

        return $this->render('PagesBundle:Administration:pages/layout/edit.html.twig', array(
            'page' => $page,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Pages entity.
     *
     * @Route("/{id}", name="admin_pages_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pages $page)
    {
        $form = $this->createDeleteForm($page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($page);
            $em->flush();
        }

        return $this->redirectToRoute('admin_pages_index');
    }

    /**
     * Creates a form to delete a Pages entity.
     *
     * @param Pages $page The Pages entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pages $page)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_pages_delete', array('id' => $page->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
