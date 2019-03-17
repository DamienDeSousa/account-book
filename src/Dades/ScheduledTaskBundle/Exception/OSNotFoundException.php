<?php

namespace Dades\ScheduledTaskBundle\Exception;

class OSNotFoundException extends \Exception
{
    public function __construct(string $message, int $code, string $file, int $line)
    {
        parent::__construct($message, $code);
        $this->file = $file;
        $this->line = $line;
    }

    public function getExplicitMessage()
    {
        return $this->getMessage()." in ".$this->getFile()." at line ".$this->getLine().PHP_EOL.$this->getTraceAsString().PHP_EOL;
    }
}