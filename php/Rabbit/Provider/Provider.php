<?php

declare(strict_types = 1);

namespace App\Rabbit\Provider;

class Provider
{
    public function provideMessage(): string
    {
        return getenv('MESSAGE');
    }

    public function provideRepeatCount(): int
    {
        return (int) getenv('REPEAT_COUNT');
    }
}
