<?php

namespace PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PagesController extends Controller
{
    /**
     * @Route("/page/{id}", name="page")
     */
    public function pageAction($id)
    {
        return $this->render('PagesBundle:Default:pages/layout/pages.html.twig');
    }
}
