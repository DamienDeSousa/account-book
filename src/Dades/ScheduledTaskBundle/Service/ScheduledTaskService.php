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

/**
 * Service to use for manage the scheduled tasks.
 *
 * @author Damien DE SOUSA
 */
class ScheduledTaskService implements Occurence
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
     * @param  string        $name      [description]
     * @param  string        $occurence [description]
     * @param  string        $command   [description]
     * @param  string        $startTime [description]
     * @return ScheduledTask            [description]
     */
    public function create(string $name, string $occurence, string $command, string $startTime): ScheduledTask
    {
        $scheduledTask = new ScheduledTask();
        $scheduledTask->setName($name)
            ->setOccurence($occurence)
            ->setCommand($command)
            ->setStartTime($startTime);

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
            $this->factory->create($scheduledTask->getName())
                ->schedule($scheduledTask->getOccurence())
                ->command($scheduledTask->getCommand())
                ->startAt($scheduledTask->getStartTime())
                ->launch();

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
        //pour la mise a jour en base: rien de nouveau, simplement utiliser Doctrine
        //pour la mise à jour de la tache: recréer une tache par dessus avec /F
        //si on change le nom de la tache, il faut d'abord la supprimer de la base et ensuite la recréer
        if (!$scheduledTask) {
            throw new NoSuchEntityException("The ScheduledTask given is null", 1);
        }

        try {
            $this->factory->create($scheduledTask->getName())
              ->schedule($scheduledTask->getOccurence())
              ->command($scheduledTask->getCommand())
              ->startAt($scheduledTask->getStartTime())
              ->launch();

            $this->entityManager->flush();
        } catch (BadCommandException $e) {
            $this->logger->writeLog($e->getCode(), $e->getExplicitMessage());
        }
    }
}
