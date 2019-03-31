<?php

namespace Dades\ScheduledTaskBundle\Service\Factory;

use Dades\ScheduledTaskBundle\Exception\BadCommandException;
use Dades\ScheduledTaskBundle\Service\Factory\ScheduledFactory;
use Dades\ScheduledTaskBundle\Service\Logger;
use Symfony\Component\Process\Pipes\WindowsPipes;

/**
 * WindowsScheduledFactory creates and builds scheduled tasks on Windows
 *
 * @author Damien DE SOUSA
 */
class WindowsScheduledFactory extends ScheduledFactory
{
    /**
     * Scheduled command to execute
     * @var string
     */
    protected $command;

    /**
     * Windows command to execute on the terminal to schedule the task
     * @var [type]
     */
    protected $toBuild;

    /**
     * Write error in logs
     * @var Logger
     */
    protected $logger;

    /**
     * @param Logger $logger [description]
     */
    public function __construct(Logger $logger)
    {
        $this->command = "schtasks ";
        $this->toBuild = "";
        $this->logger = $logger;
    }

    /**
     * The first step on the creation of the scheduled task
     * @param  string           $name [description]
     * @return ScheduledFactory       [description]
     */
    public function create(string $name): ScheduledFactory
    {
        $this->toBuild = $this->command." /F ";
        $this->toBuild .= "/Create /TN ".$name." ";
        return $this;
    }

    /**
     * Set the occurence of the task execution
     * @param  string           $occurence [description]
     * @return ScheduledFactory            [description]
     */
    public function schedule(string $occurence): ScheduledFactory
    {
        $this->toBuild .= "/SC ".$occurence." ";
        return $this;
    }

    /**
     * The command line to execute
     * @param  string           $command [description]
     * @return ScheduledFactory          [description]
     */
    public function command(string $command): ScheduledFactory
    {
        $this->toBuild .= "/TR \"".$command."\" ";
        return $this;
    }

    /**
     * Set the first time when the task will be execute
     * @param  string           $hour [description]
     * @return ScheduledFactory       [description]
     */
    public function startAt(string $hour): ScheduledFactory
    {
        $this->toBuild .= "/ST ".$hour." ";
        return $this;
    }

    /**
     * Launch the scheduled task
     * @return ScheduledFactory [description]
     * @throws BadCommandException
     */
    public function launch(): ScheduledFactory
    {
        $output = [];
        $status;
        exec($this->toBuild." 2>&1", $output, $status);
        if ($status !== 0) {
            throw new BadCommandException(
                $this->toBuild,
                $this->logger->stringifyOutput($output),
                1,
                __FILE__,
                __LINE__
            );
        }
        $this->clear();
        return $this;
    }

    /**
     * Clear the command line
     * @return ScheduledFactory [description]
     */
    public function clear(): ScheduledFactory
    {
        $this->toBuild = "";
        return $this;
    }

    /**
     * Start the update of a scheduled task
     * @deprecated
     * @param  string $name [description]
     * @return ScheduledFactory       [description]
     */
    public function update(string $name): ScheduledFactory
    {
        return $this;
    }

    /**
     * Delete a scheduled task on Windows
     * @param  string $name [description]
     * @return ScheduledFactory       [description]
     */
    public function delete(string $name): ScheduledFactory
    {
        $this->toBuild = $this->command." /Delete /F /TN ".$name;

        return $this;
    }

    /**
     * Determine the frequency to execute the task
     * @param  string        $frequency [description]
     * @return ScheduledTask            [description]
     */
    public function every(string $frequency): ScheduledFactory
    {
        $this->toBuild .= "/MO ".$frequency." ";

        return $this;
    }

    /**
     * Set the day that the task will be execute
     * @param  string           $day [description]
     * @return ScheduledFactory      [description]
     */
    public function day(string $day): ScheduledFactory
    {
        $this->toBuild .= "/D ".$day." ";

        return $this;
    }

    /**
     * Set the month that the task will be execute
     * @param  string           $month [description]
     * @return ScheduledFactory        [description]
     */
    public function month(string $month): ScheduledFactory
    {
        $this->toBuild .= "/M ".$month." ";

        return $this;
    }
}
