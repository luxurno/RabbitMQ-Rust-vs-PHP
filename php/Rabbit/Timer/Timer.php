<?php

declare(strict_types = 1);

namespace App\Rabbit\Timer;

class Timer
{
    /** @var float|string */
    private $startTime;

    public function __construct()
    {
        $this->startTime = microtime(true);
    }

    public function stopTimer(): void
    {
        $diff = microtime(true) - $this->startTime;

        $sec = intval($diff);
        $micro = $diff - $sec;

        $endTime = sprintf('%.6f', $micro * 1000);

        echo $endTime . "ms\n";
    }
}
