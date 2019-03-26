<?php

namespace Dades\ScheduledTaskBundle\Exception;

class NoSuchEntityException extends \Exception
{
    public function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }

    public function getExplicitMessage()
    {
        $message = $this->message;
        $message .= "Stack trace:".PHP_EOL;
        $message .= $this->getTraceAsString().PHP_EOL;

        return $message;
    }
}
