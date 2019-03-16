<?php

namespace Dades\ScheduledTaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScheduledTask
 *
 * @ORM\Table(name="scheduled_task")
 * @ORM\Entity(repositoryClass="Dades\ScheduledTaskBundle\Repository\ScheduledTaskRepository")
 */
class ScheduledTask
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="occurence", type="string", length=255)
     */
    private $occurence;

    /**
     * @var string
     *
     * @ORM\Column(name="command", type="string", length=255)
     */
    private $command;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="string", length=255)
     */
    private $startTime;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ScheduledTask
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set occurence
     *
     * @param string $occurence
     *
     * @return ScheduledTask
     */
    public function setOccurence($occurence)
    {
        $this->occurence = $occurence;

        return $this;
    }

    /**
     * Get occurence
     *
     * @return string
     */
    public function getOccurence()
    {
        return $this->occurence;
    }

    /**
     * Set command
     *
     * @param string $command
     *
     * @return ScheduledTask
     */
    public function setCommand($command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get command
     *
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return ScheduledTask
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }
}

