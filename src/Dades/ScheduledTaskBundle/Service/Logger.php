<?php

namespace Dades\ScheduledTaskBundle\Service;

use Dades\ScheduledTaskBundle\Service\Utility\ConvertEncode;

/**
 * Log messages in var/logs/dades_scheduled_task_bundle.log
 * @author Damien DE SOUSA
 */
class Logger
{
    /**
     * The file in which the logs will be written
     * @var string
     */
    protected $fileLog;

    /**
     * @param ConvertEncode $convertEncode [description]
     */
    public function __construct(ConvertEncode $convertEncode)
    {
        $this->fileLog = "../var/logs/dades_scheduled_task_bundle.log";

        if (!file_exists($this->fileLog)) {
            file_put_contents('dades_scheduled_task_bundle.log', "");
            rename('dades_scheduled_task_bundle.log', $this->fileLog);
        }
    }

    /**
     * Write log with the status code and the message to write
     * @param  int    $status [description]
     * @param  array|string $output [description]
     */
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

    /**
     * Transforme an array to a string
     * @param  array  $output [description]
     * @return string         [description]
     */
    public function stringifyOutput(array $output): string
    {
        $result = "";
        foreach ($output as $key => $value) {
            $result .= $value.PHP_EOL;
        }
        return $result;
    }

    /**
     * Get the current date
     * @return [type] [description]
     */
    protected function getDate()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * Get the current file
     * @return string [description]
     */
    public function getFile()
    {
        return $this->fileLog;
    }
}
