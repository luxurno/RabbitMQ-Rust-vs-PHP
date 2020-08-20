<?php

declare(strict_types = 1);

namespace App\Rabbit\Connection;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class Connection
{
    /** @var AMQPStreamConnection */
    private $connection;

    public function __construct()
    {
        $this->connection = $this->connect();
    }

    public function connect(): AMQPStreamConnection
    {
        return new AMQPStreamConnection(
            $this->getRabbitHost(),
            $this->getRabbitPort(),
            $this->getRabbitUser(),
            $this->getRabbitPass(),
            $this->getRabbitVhost()
        );
    }

    public function getRabbitHost(): string
    {
        return getenv('RABBIT_HOST');
    }

    public function getRabbitPort(): int
    {
        return (int) getenv('RABBIT_PORT');
    }

    public function getRabbitUser(): string
    {
        return getenv('RABBIT_USER');
    }


    public function getRabbitPass(): string
    {
        return getenv('RABBIT_PASS');
    }


    public function getRabbitVhost(): string
    {
        return getenv('RABBIT_VHOST');
    }

    public function getConnection(): AMQPStreamConnection
    {
        return $this->connection;
    }
}
