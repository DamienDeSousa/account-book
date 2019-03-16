<?php

namespace Dades\ScheduledTaskBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Dades\ScheduledTaskBundle\Entity\ScheduledTask;
use Dades\ScheduledTaskBundle\Service\Factory\ScheduledFactory;

class ScheduledTaskService
{
    protected $factory;
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->factory = ScheduledFactory::getFactory();
        $this->entityManager = $entityManager;
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
        $this->entityManager->persist($scheduledTask);
        $this->entityManager->flush();

        $this->factory->create($scheduledTask->getName())
                      ->schedule($scheduledTask->getOccurence())
                      ->command($scheduledTask->getCommand())
                      ->startAt($scheduledTask->getStartTime())
                      ->launch();
    }

    public function update()
    {

    }

    public function delete()
    {

    }
    //START / STOP
}