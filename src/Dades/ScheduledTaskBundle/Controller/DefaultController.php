<?php

namespace Dades\ScheduledTaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DadesScheduledTaskBundle:Default:index.html.twig');
    }
}
