<?php

namespace Dades\ScheduledTaskBundle\Service\Utility;

/**
 * Define the specific day of week
 * @author Damien DE SOUSA
 */
interface WeekOfMonth
{
    /**
     * First week of a month
     * @var string
     */
    const FIRST = "FIRST";

    /**
     * Second week of a month
     * @var string
     */
    const SECOND = "SECOND";

    /**
     * Third week of a month
     * @var string
     */
    const THIRD = "THIRD";

    /**
     * Fourth week of a month
     * @var string
     */
    const FOURTH = "FOURTH";

    /**
     * Last week of a month
     * @var string
     */
    const LAST = "LAST";
}
