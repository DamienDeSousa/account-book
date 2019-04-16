<?php

namespace Dades\ScheduledTaskBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dades\ScheduledTaskBundle\Service\ScheduledTaskService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Dades\ScheduledTaskBundle\Exception\BadCommandException;

class DefaultController extends Controller
{
    /**
     * @Route("/dades", name="dadespage")
     */
    public function indexAction(ScheduledTaskService $scheduledTaskService)
    {
        $task1 = $scheduledTaskService->create();
        $task1->setCommand("notepad.exe")->setCronExpresion("*/5 * * * *");

        $task2 = $scheduledTaskService->create();
        $task2->setCommand("calc")->setCronExpresion("30 * * * *");

        $scheduledTaskService->save($task1);
        $scheduledTaskService->save($task2);
        
        return new Response("it works");
    }
}
//https://sites.google.com/site/ballif1073/windows/taches-planifiees

//schtasks /Create /TN nom /SC ONCE /TR notepad.exe /ST 23:33:00
//schtasks /Delete /TN nom

//schtasks /Create /TN nom2 /SC ONCE /TR "php D:\symfonyProjects\3.4\account-book\bin\console doctrine:schema:update --force" /ST 20:26:00
//https://packagist.org/packages/lavary/crunz (cron for unix kernel)

/**
 * Ajouter la compatibilité sur Unix / Linux
 * https://docs.microsoft.com/en-us/windows-server/administration/windows-commands/schtasks#BKMK_create
 */
