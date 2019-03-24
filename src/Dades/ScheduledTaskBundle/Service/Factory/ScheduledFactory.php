<?php

namespace Dades\ScheduledTaskBundle\Service\Factory;

use Dades\ScheduledTaskBundle\Service\Logger;
use \Dades\ScheduledTaskBundle\Exception\OSNotFoundException;
use \Dades\ScheduledTaskBundle\Service\Factory\WindowsScheduledFactory;

/**
 * CYGWIN_NT-5.1 : is a POSIX-compatible environnement that runs natively on Windows.
 *                 It allows Unix programs to run natively under Windows.
 */
define('WINDOWS', ['WINNT', 'WIN32', 'Windows', 'CYGWIN_NT-5.1']);

define('MACOS', ['Darwin']);

define('UNIX', ['FreeBSD', 'HP-UX', 'IRIX64', 'NetBSD', 'OpenBSD', 'SunOS', 'Unix']);

define('LINUX', ['Linux']);

/**
 * Abstract factory that return the right factory to build scheduled task on
 * Windows, Linux or MacOS
 *
 * @author Damien DE SOUSA
 */
abstract class ScheduledFactory
{
    /**
     * Return the right factory to build scheduled task
     * @param  Logger           $logger [description]
     * @return ScheduledFactory         [description]
     */
    public static function getFactory(Logger $logger): ScheduledFactory
    {
        $os = PHP_OS;

        switch ($os) {
            case \in_array($os, WINDOWS):
                return new WindowsScheduledFactory($logger);
                break;
            case \in_array($os, MACOS):
                break;
            case in_array($os, UNIX):
                break;
            case \in_array($os, LINUX):
                break;
            default:
                throw new OSNotFoundException("The operating system [".$os."] was not found", 1, __FILE__, __LINE__);
        }
    }

    abstract public function create(string $name): ScheduledFactory;

    abstract public function schedule(string $occurence): ScheduledFactory;

    abstract public function command(string $command): ScheduledFactory;

    abstract public function startAt(string $hour): ScheduledFactory;

    abstract public function launch(): ScheduledFactory;

    abstract public function update(string $name): ScheduledFactory;

    abstract public function delete(string $name): ScheduledFactory;

    abstract public function clear(): ScheduledFactory;
}
