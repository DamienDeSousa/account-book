<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Entity\Account;
use AppBundle\Service\AccountService;
use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //test if the user is logged in
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return new Response('je suis connecté');
        }
        
        // replace this example code with whatever you need
        return $this->render('AppBundle/home.html.twig');
    }

    /**
     * @Route("/debug", name="debugpage")
     */
    public function debug(Request $request, AccountService $accountService)
    {
        /*$repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->find(1);
        $account = $accountService->create("nom", 0.0, -150, $user);
        $accountService->save($account);*/
    }
}
