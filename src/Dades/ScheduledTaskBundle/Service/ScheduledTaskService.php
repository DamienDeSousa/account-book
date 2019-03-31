<?php

namespace Dades\ScheduledTaskBundle\Service;

use Dades\ScheduledTaskBundle\Entity\ScheduledTask;
use Dades\ScheduledTaskBundle\Exception\BadCommandException;
use Dades\ScheduledTaskBundle\Service\Factory\ScheduledFactory;
use Doctrine\ORM\EntityManagerInterface;
use Dades\ScheduledTaskBundle\Exception\OSNotFoundException;
use Dades\ScheduledTaskBundle\Exception\NoSuchEntityException;
use Dades\ScheduledTaskBundle\Service\Logger;
use Dades\ScheduledTaskBundle\Service\Utility\Occurence;
use Dades\ScheduledTaskBundle\Service\Utility\DayOfWeek;
use Dades\ScheduledTaskBundle\Service\Utility\WeekOfMonth;

/**
 * Service to use for manage the scheduled tasks.
 *
 * @author Damien DE SOUSA
 */
class ScheduledTaskService implements Occurence, DayOfWeek, WeekOfMonth
{
    /**
     * Factory that build a scheduled task
     * @var ScheduledFactory]
     */
    protected $factory;

    /**
     * EntityManager
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Logger
     * @var Logger
     */
    protected $logger;

    /**
     * [__construct description]
     * @param EntityManagerInterface $entityManager [description]
     * @param Logger                 $logger        [description]
     */
    public function __construct(EntityManagerInterface $entityManager, Logger $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;

        try {
            $this->factory = ScheduledFactory::getFactory($logger);
        } catch (OSNotFoundException $e) {
            $this->factory = null;
            $this->logger->writeLog($e->getCode(), $e->getExplicitMessage());
        }
    }

    /**
     * Create a new ScheduledTask
     * @return ScheduledTask [description]
     */
    public function create(): ScheduledTask
    {
        $scheduledTask = new ScheduledTask();

        return $scheduledTask;
    }

    /**
     * [save description]
     * @param  ScheduledTask $scheduledTask [description]
     * @return [type]                       [description]
     */
    public function save(ScheduledTask $scheduledTask)
    {
        //tester si le nom est unique
        try {
            $this->setScheduledCommand($scheduledTask);
            $this->factory->launch();

            $this->entityManager->persist($scheduledTask);
            $this->entityManager->flush();
        } catch (BadCommandException $e) {
            $this->logger->writeLog($e->getCode(), $e->getExplicitMessage());
        }
    }

    /**
     * Delete a specific scheduled task by its name
     * @param  string $name [description]
     * @return void       [description]
     */
    public function deleteByName(string $name)
    {
        try {
            $this->factory->delete($name)->launch();

            $scheduledTask = $this->getByName($name);

            $this->entityManager->remove($scheduledTask);
            $this->entityManager->flush();
        } catch (BadCommandException $e) {
            $this->logger->writeLog($e->getCode(), $e->getExplicitMessage());
        } catch (NoSuchEntityException $e) {
            $this->logger->writeLog($e->getCode(), $e->getExplicitMessage());
        }
    }

    /**
     * Get a scheduled task by its name
     * @param  string        $name [description]
     * @return ScheduledTask       [description]
     * @throws NoSuchEntityException
     */
    public function getByName(string $name): ScheduledTask
    {
        $scheduledTask = $this->entityManager
          ->getRepository(ScheduledTask::class)
          ->findOneBy(["name" => $name]);

        if (!$scheduledTask) {
            throw new NoSuchEntityException("There is no ScheduledTask with name like '$name'", 1);
        }

        return $scheduledTask;
    }

    /**
     * Update a scheduled task
     * @param  ScheduledTask $scheduledTask [description]
     * @return void                       [description]
     */
    public function update(ScheduledTask $scheduledTask)
    {
        if (!$scheduledTask) {
            throw new NoSuchEntityException("The ScheduledTask given is null", 1);
        }

        try {
            $this->setScheduledCommand($scheduledTask);
            $this->factory->launch();

            $this->entityManager->flush();
        } catch (BadCommandException $e) {
            $this->logger->writeLog($e->getCode(), $e->getExplicitMessage());
        }
    }

    /**
     * Set all the parameters for the schedule command line
     *
     * @param ScheduledTask $scheduledTask
     * @return void
     */
    protected function setScheduledCommand(ScheduledTask $scheduledTask)
    {
        $this->factory->create($scheduledTask->getName())
          ->schedule($scheduledTask->getOccurence())
          ->command($scheduledTask->getCommand());

        if ($scheduledTask->getStartTime() !== "") {
            $this->factory->startAt($scheduledTask->getStartTime());
        }

        if ($scheduledTask->getFrequency() !== "") {
            $this->factory->every($scheduledTask->getFrequency());
        }

        if ($scheduledTask->getDay() !== "") {
            $this->factory->day($scheduledTask->getDay());
        }

        if ($scheduledTask->getMonth() !== "") {
            $this->factory->month($scheduledTask->getMonth());
        }
    }

    /**
     * Run a task on a specific date each month
     * @param  ScheduledTask $scheduledTask [description]
     * @param  string        $day           Between 1 and 31
     * @return ScheduledTask                [description]
     */
    public function everySpecificDateOfMonth(ScheduledTask $scheduledTask, string $day): ScheduledTask
    {
        $scheduledTask->setDay($day)
          ->setOccurence(ScheduledTaskService::MONTHLY);

        return $scheduledTask;
    }

    /**
     * Run a task every month at the last day
     * @return ScheduledFactory [description]
     */
    public function everyLastDayOfMonth(ScheduledTask $scheduledTask): ScheduledTask
    {
        $scheduledTask->setOccurence(ScheduledTaskService::MONTHLY)
          ->setFrequency(ScheduledTaskService::LASTDAY)
          ->setMonth("*");

        return $scheduledTask;
    }
}
