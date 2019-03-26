<?php

namespace Dades\ScheduledTaskBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dades\ScheduledTaskBundle\Service\ScheduledTaskService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Dades\ScheduledTaskBundle\Exception\BadCommandException;

///use Dades\ScheduledTaskBundle\Service\Factory\ScheduledFactory;

class DefaultController extends Controller
{
    /**
     * @Route("/dades", name="dadespage")
     */
    public function indexAction(ScheduledTaskService $scheduledTaskService)
    {
        /*$scheduledTask = $scheduledTaskService->create("nom", ScheduledTaskService::ONCE, "notepad.exe", "21:01:00");
        $scheduledTaskService->save($scheduledTask);*/
        //$scheduledTask = $scheduledTaskService->getByName("nom");
        //$scheduledTaskService->update($scheduledTask);
        $scheduledTaskService->deleteByName("nom2");

        die();
        return new Response($scheduledTask);
    }
}
//https://sites.google.com/site/ballif1073/windows/taches-planifiees

//schtasks /Create /TN nom /SC ONCE /TR notepad.exe /ST 23:33:00
//schtasks /Delete /TN nom

//schtasks /Create /TN nom2 /SC ONCE /TR "php D:\symfonyProjects\3.4\account-book\bin\console doctrine:schema:update --force" /ST 20:26:00

/**
 * Modifier l'encodage des caractères des messages d'erreurs en UTF-8.
 * Ajouter la compatibilité sur Unix
 * Evolutions:
 *  - schedule more specificly (every 20 minutes, every 3 hours, every 4 week, ...)
 *  - schedule a specific day of week
 *  - schedule a specific week of month
 *  - schedule on aspecific date each month
 *  - schedule on the last day of a month
 */
