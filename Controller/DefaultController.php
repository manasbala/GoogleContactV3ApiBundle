<?php

namespace MB\GoogleContactV3ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MBGoogleContactV3ApiBundle:Default:index.html.twig');
    }
}
