<?php

namespace Dades\ScheduledTaskBundle\Service\Utility;

/**
 * Contains all the available occurence on Windows OS
 * @author Damien DE SOUSA
 */
interface Occurence
{
    /**
     * Execute a task once
     * @var string
     */
    const ONCE = "once";

    /**
     * Execute a task per minute
     * @var string
     */
    const MINUTE = "minute";

    /**
     * Execute a task per hour
     * @var string
     */
    const HOURLY = "hourly";

    /**
     * Execute a task per day
     * @var string
     */
    const DAILY = "daily";

    /**
     * Execute a task per week
     * @var string
     */
    const WEEKLY = "weekly";

    /**
     * Execute a task per month
     * @var string
     */
    const MONTHLY = "monthly";
}
