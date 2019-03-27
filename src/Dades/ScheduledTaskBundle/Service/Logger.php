<?php

namespace Dades\ScheduledTaskBundle\Service;

use Dades\ScheduledTaskBundle\Service\Utility\ConvertEncode;

class Logger
{
    protected $fileLog;

    public function __construct(ConvertEncode $convertEncode)
    {
        $this->fileLog = "../var/logs/dades_scheduled_task_bundle.log";

        if (!file_exists($this->fileLog)) {
            file_put_contents('dades_scheduled_task_bundle.log', "");
            rename('dades_scheduled_task_bundle.log', $this->fileLog);
        }
    }

    public function writeLog(int $status, $output)
    {
        $message = "";
        if (is_array($output)) {
            $message = $this->stringifyOutput($output);
        } elseif (is_string($output)) {
            $message = $output;
        }

        file_put_contents(
            $this->fileLog,
            "[".$this->getDate()."]: ".$message.PHP_EOL,
            FILE_APPEND
        );
    }

    public function stringifyOutput(array $output): string
    {
        $result = "";
        foreach ($output as $key => $value) {
            $result .= $value.PHP_EOL;
        }
        return $result;
    }

    protected function getDate()
    {
        return date('Y-m-d H:i:s');
    }

    public function getFile()
    {
        return $this->fileLog;
    }
}
