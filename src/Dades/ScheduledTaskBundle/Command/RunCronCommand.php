<?php

namespace Dades\ScheduledTaskBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Dades\ScheduledTaskBundle\Service\ScheduledTaskService;
use Dades\ScheduledTaskBundle\Service\Logger;

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

    protected $projectDir;
    protected $fileLog;
    protected $scheduledTaskService;

    /**
     * ScheduledTaskService that manage ScheduledTask
     * @var ScheduledTaskService
     */
    protected $scheduledTaskService;

    public function __construct(string $projectdir, string $fileLog, ScheduledTaskService $scheduledTaskService)
    {
        parent::__construct();

        $this->projectDir = $projectdir;
        $this->fileLog = $fileLog;
        $this->scheduledTaskService = $scheduledTaskService;
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
        //DONE : déléguer le système de log à un service dédié
        //créer des commandes et les exécuter
        //faire du test en masse

        //https://stackoverflow.com/questions/11209529/how-to-access-an-application-parameters-from-a-service

        $result = [];
        $status = 0;

        //exec("echo ".$this->projectDir." >> ".$this->projectDir."\\var\\logs\\".$this->fileLog, $result, $status);

        if ($status !== 0) {
            //appel au service de log, et on passe $result en param
            $logger = new Logger($this->projectDir, $this->fileLog);
            $logger->writeLog(1, ["hrvvhfqvqh", "aaaaa"]);
        }
        //commande à créer:
        //schtasks /CREATE /TN "account_book_cron" /TR "php D:\symfonyProjects\3.4\account-book\bin\console cron:run" /SC minute
        //>> D:\symfonyProjects\3.4\account-book\var\logs\dades_scheduled_task_bundle.log 2>&1

        //linux: ls ~/Document/symfonyProjects/3.4/account-book/var/dades_scheduled_task_bundle.log
        //* * * * * php ~/Document/symfonyProjects/3.4/account-book/bin/console cron:run
    }
}

//next step: ne pas injecter le logger, mais le créer directement dans le if
