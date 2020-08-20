<?php

declare(strict_types = 1);

namespace App\Rabbit;

use App\Rabbit\Connection\Connection;
use App\Rabbit\Provider\Provider;
use App\Rabbit\Timer\Timer;
use PhpAmqpLib\Message\AMQPMessage;

class Main
{
    private const QUEUE_PHP_NAME = 'queue_php';

    /** @var Connection */
    private $connection;
    /** @var Provider */
    private $provider;
    /** @var Timer */
    private $timer;

    public function __construct(
        Connection $connection,
        Provider $provider,
        Timer $timer
    )
    {
        $this->connection = $connection;
        $this->provider = $provider;
        $this->timer = $timer;
    }

    public function process(): void
    {
        $message = new AMQPMessage($this->provider->provideMessage());
        $connection = $this->connection->getConnection();
        $channel = $connection->channel();
        $channel->queue_declare(self::QUEUE_PHP_NAME, false, true, false, false);

        for ($i=1; $i<= $this->provider->provideRepeatCount(); $i++) {
            $channel->basic_publish($message, '', self::QUEUE_PHP_NAME);
        }
        $channel->close();

        $this->timer->stopTimer();
    }


}
