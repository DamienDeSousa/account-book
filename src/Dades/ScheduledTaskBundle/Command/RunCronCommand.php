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
        $this->setDescription("Run all scrons.")
            ->setHelp("Run all crons created in Symfony.");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = "echo ceci est un test >> var/logs/dades_scheduled_task_bundle.log";
        $output = [];
        $status;
        exec($command, $output, $status);
    }
}
