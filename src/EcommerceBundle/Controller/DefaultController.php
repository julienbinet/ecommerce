<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/{name}")
     */
    public function indexAction($name)
    {
        $tontons = array("tonton1", "tonton2", "tonton3");
        return $this->render('EcommerceBundle:Default:index.html.twig', array('nom'=>$name, "tontons" => $tontons));
    }
}
