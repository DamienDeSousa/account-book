<?php

namespace Dades\ScheduledTaskBundle\Service\Factory;

use \Dades\ScheduledTaskBundle\Service\Factory\WindowsScheduledFactory;

/**
 * CYGWIN_NT-5.1 : is a POSIX-compatible environnement that runs natively on Windows.
 *                 It allows Unix programs to run natively under Windows.
 */
define('WINDOWS', ['WINNT', 'WIN32', 'Windows', 'CYGWIN_NT-5.1']);

define('MACOS', ['Darwin']);

define('UNIX', ['FreeBSD', 'HP-UX', 'IRIX64', 'NetBSD', 'OpenBSD', 'SunOS', 'Unix']);

define('LINUX', ['Linux']);

abstract class ScheduledFactory
{
    public static function getFactory(): ScheduledFactory
    {
        $os = PHP_OS;

        switch($os) {
            case \in_array($os, WINDOWS):
                return new WindowsScheduledFactory();
                break;
            case \in_array($os, MACOS):
                break;
            case in_array($os, UNIX):
                break;
            case \in_array($os, LINUX):
                break;
            default:
                //lancer une erreur
        }
    }

    public abstract function create(string $name): ScheduledFactory;

    public abstract function schedule(string $occurence): ScheduledFactory;

    public abstract function command(string $command): ScheduledFactory;

    public abstract function startAt(string $hour): ScheduledFactory;

    public abstract function launch(): ScheduledFactory;

    public abstract function update(string $name);

    public abstract function delete(string $name);
}