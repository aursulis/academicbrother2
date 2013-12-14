<?php

namespace AB\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ABBundle:Default:index.html.twig');
    }

    public function aboutAction() 
    {
    	return $this->render('ABBundle:Default:index.html.twig');
    }
}
