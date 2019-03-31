<?php

namespace Dades\ScheduledTaskBundle\Service\Utility;

/**
 * Defines the different days of week
 * @author Damien DE SOUSA
 */
interface DayOfWeek
{
    /**
     * Monday
     * @var string
     */
    const MON = "MON";

    /**
     * Tuesday
     * @var string
     */
    const TUE = "TUE";

    /**
     * Wednesday
     * @var string
     */
    const WED = "WED";

    /**
     * Thursday
     * @var string
     */
    const THU = "THU";

    /**
     * Friday
     * @var string
     */
    const FRI = "FRI";

    /**
     * Saturday
     * @var string
     */
    const SAT = "SAT";

    /**
     * Sunday
     * @var string
     */
    const SUN = "SUN";

    /**
     * The last day of the month
     * @var string
     */
    const LASTDAY = "LASTDAY";
}
