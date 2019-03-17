<?php

namespace Dades\ScheduledTaskBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use \Dades\ScheduledTaskBundle\Service\Logger;
use Dades\ScheduledTaskBundle\Entity\ScheduledTask;
use Dades\ScheduledTaskBundle\Exception\BadCommandException;
use \Dades\ScheduledTaskBundle\Exception\OSNotFoundException;
use Dades\ScheduledTaskBundle\Service\Factory\ScheduledFactory;

class ScheduledTaskService
{
    protected $factory;
    protected $entityManager;
    protected $logger;

    public function __construct(EntityManagerInterface $entityManager, Logger $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;

        try {
            $this->factory = ScheduledFactory::getFactory($logger);
        } catch(OSNotFoundException $e) {
            $this->factory = null;
            $this->logger->writeLog($e->getCode(), $e->getExplicitMessage());
        }
    }

    //CRUD
    public function create(string $name, string $occurence, string $command, string $startTime): ScheduledTask
    {        
        $scheduledTask = new ScheduledTask();
        $scheduledTask->setName($name)
                      ->setOccurence($occurence)
                      ->setCommand($command)
                      ->setStartTime($startTime);
        
        return $scheduledTask;
    }

    public function save(ScheduledTask $scheduledTask)
    {
        //tester si le nom est unique
        try {
            $this->factory->create($scheduledTask->getName())
            ->schedule($scheduledTask->getOccurence())
            ->command($scheduledTask->getCommand())
            ->startAt($scheduledTask->getStartTime())
            ->launch();
        } catch (BadCommandException $e) {
            $this->logger->writeLog($e->getCode(), $e->getExplicitMessage());
        }
        
        
        $this->entityManager->persist($scheduledTask);
        $this->entityManager->flush();
    }

    public function update()
    {

    }

    public function delete()
    {

    }
    //START / STOP
}