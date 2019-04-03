<?php

namespace Dades\ScheduledTaskBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dades\ScheduledTaskBundle\Service\ScheduledTaskService;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Dades\ScheduledTaskBundle\Exception\BadCommandException;
use Cron\CronExpression;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/dades", name="dadespage")
     */
    public function indexAction(ScheduledTaskService $scheduledTaskService)
    {
        /*$scheduledTask = $scheduledTaskService->getByName("nom");
        $scheduledTaskService->deleteByName("nom");*/
        $cron = CronExpression::factory('* * * * *');
        echo $cron->isDue()."<br/>";
        echo $cron->getNextRunDate()->format('Y-m-d H:i:s')."<br/>";
        echo $cron->getPreviousRunDate()->format('Y-m-d H:i:s');
        die();
        return new Response($scheduledTask);
    }

    /**
     * @Route("/debug", name="debugpage")
     */
    public function debugAction()
    {
        /*$cron = CronExpression::factory('@daily');
        $cron->isDue();
        echo $cron->getNextRunDate()->format('Y-m-d H:i:s');
        echo $cron->getPreviousRunDate()->format('Y-m-d H:i:s');*/

        return new Response("");
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

 /*$scheduledTask = $scheduledTaskService->create();
 $scheduledTask->setName("nom")
   ->setCommand("notepad.exe")
 ->setStartTime("16:13:00");
 $scheduledTaskService->everySpecificDateOfMonth($scheduledTask, "31");

 $scheduledTaskService->save($scheduledTask);*/

 /*$scheduledTask = $scheduledTaskService->getByName("nom");
 $scheduledTask->setFrequency(2);
 $scheduledTaskService->update($scheduledTask);*/
