<?php

namespace Dades\ScheduledTaskBundle\Exception;

class BadCommandException extends \Exception
{
    protected $command;

    public function __construct(string $command, string $message, int $code, string $file, int $line)
    {
        $this->command = $command;
        $this->message = $message;
        $this->code = $code;
        $this->file = $file;
        $this->line = $line;
    }

    public function getExplicitMessage()
    {
        return "The command [$this->command] failed: $this->message in $this->file at line $this->line".PHP_EOL.$this->getTraceAsString().PHP_EOL;
    }
}