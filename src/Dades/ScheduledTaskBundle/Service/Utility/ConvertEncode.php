<?php

namespace Dades\ScheduledTaskBundle\Service\Utility;

/**
 * Convert an encoded string to another encoding
 *
 * @author Damien DE SOUSA
 */
class ConvertEncode
{
    /**
     * Convert a string to an UTF-8 encoded string
     * @param  string $message any encoding
     * @return string          UTF-8 string
     */
    public function convertToUTF8(string $message): string
    {
        return iconv($message, 'UTF-8', \mb_detect_encoding($message));
    }
}
