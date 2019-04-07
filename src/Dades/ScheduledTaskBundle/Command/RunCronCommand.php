<?php

namespace Dades\ScheduledTaskBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Dades\ScheduledTaskBundle\Service\ScheduledTaskService;

/**
 * Run all defined cron in Symfony.
 *
 * @author Damien DE SOUSA
 */
class RunCronCommand extends Command
{
    /**
     * Command that run all cron defined in this bundle
     * @var string
     */
    protected static $defaultName = 'cron:run';

    /**
     * ScheduledTaskService that manage ScheduledTask
     * @var ScheduledTaskService
     */
    protected $scheduledTaskService;

    public function __construct()
    {
        //ScheduledTaskService $scheduledTaskService
        //$this->scheduledTaskService = $scheduledTaskService;

        parent::__construct();
    }

    /**
     * Configure the command
     * @return void [description]
     */
    protected function configure()
    {
        $this->setDescription("Run all crons.")
            ->setHelp("Run all crons created in Symfony.");
    }

    /**
     * The body of the command
     * @param  InputInterface  $input  [description]
     * @param  OutputInterface $output [description]
     * @return void                  [description]
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$output->writeln('zfhrjfjevjfvb');
        //prochaines étapes:
        //DONE : exécuter le code ci-dessous et rediriger l'affichage dans le dossier var/logs/dades_scheduled_task_bundle.log
        //déléguer le système de log à un service dédié
        //créer des commandes et les exécuter
        //faire du test en masse

        //https://stackoverflow.com/questions/11209529/how-to-access-an-application-parameters-from-a-service

        /*$result = [];
        $status;
        exec("ls >> /home/damien/Documents/SymfonyProjects/3.4/account-book/var/logs/dades_scheduled_task_bundle.log", $result, $status);*/
    }
}
