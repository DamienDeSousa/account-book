<?php

namespace Dades\ScheduledTaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScheduledTask
 *
 * @ORM\Table(name="scheduled_task")
 * @ORM\Entity(repositoryClass="Dades\ScheduledTaskBundle\Repository\ScheduledTaskRepository")
 *
 * Represent a task to schedule
 * @author Damien DE SOUSA
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
     * @var string
     *
     * @ORM\Column(name="frequency", type="string", length=50, nullable=false)
     */
    private $frequency;

    /**
     * @var string
     * @ORM\Column(name="day", type="string", length=50)
     */
    private $day;

    /**
     * @var string
     * @ORM\Column(name="month", type="string", length=50)
     */
    private $month;


    /**
     * Construct a ScheduledTask entity
     */
    public function __construct()
    {
        $this->frequency = "";
        $this->day = "";
        $this->month = "";
        $this->startTime = "";
    }

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

    /**
     * Get the value of Frequency
     *
     * @return string
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set the value of Frequency
     *
     * @param string frequency
     *
     * @return self
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Get the value of Day
     *
     * @return string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set the value of Day
     *
     * @param string day
     *
     * @return self
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get the value of Month
     *
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set the value of Month
     *
     * @param string month
     *
     * @return self
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }
}
