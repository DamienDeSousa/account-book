<?php

namespace Dades\ScheduledTaskBundle\Service\Factory;

use Dades\ScheduledTaskBundle\Service\Factory\ScheduledFactory;

class WindowsScheduledFactory extends ScheduledFactory
{
    protected $command;

    protected $toBuild;

    public function __construct()
    {
        $this->command = "schtasks /F ";
        $this->toBuild = "";
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
        exec($this->toBuild);
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