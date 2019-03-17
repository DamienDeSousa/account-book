<?php

namespace Dades\ScheduledTaskBundle\Service\Factory;

use \Dades\ScheduledTaskBundle\Service\Logger;
use Dades\ScheduledTaskBundle\Service\Factory\ScheduledFactory;

class WindowsScheduledFactory extends ScheduledFactory
{
    protected $command;

    protected $toBuild;

    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->command = "schtasks /F ";
        $this->toBuild = "";
        $this->logger = $logger;
    }

    public function create(string $name): ScheduledFactory
    {
        $this->toBuild = $this->command." ";
        $this->toBuild .= "/Create /TN ".$name." ";
        return $this;
    }

    public function schedule(string $occurence): ScheduledFactory
    {
        $this->toBuild .= "/SC ".$occurence." ";
        return $this;
    }

    public function command(string $command): ScheduledFactory
    {
        $this->toBuild .= "/TR \"".$command."\" ";
        return $this;
    }

    public function startAt(string $hour): ScheduledFactory
    {
        $this->toBuild .= "/ST ".$hour." ";
        return $this;
    }

    public function launch(): ScheduledFactory
    {
        $output = [];
        $status;
        exec($this->toBuild." 2>&1", $output, $status);
        if ($status !== 0) {
            $this->logger->writeLog($status, $output);
            //lancer une exception
        }
        $this->clear();
        return $this;
    }

    public function clear(): ScheduledFactory
    {
        $this->toBuild = "";
        return $this;
    }

    public function update(string $name)
    {

    }

    public function delete(string $name)
    {

    }
}