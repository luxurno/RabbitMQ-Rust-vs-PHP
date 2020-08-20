<?php

declare(strict_types = 1);

namespace App;

include __DIR__ . '/../vendor/autoload.php';

use App\Rabbit\Connection\Connection;
use App\Rabbit\Main;
use App\Rabbit\Provider\Provider;
use App\Rabbit\Timer\Timer;

$main = new Main(new Connection(), new Provider(), new Timer());
$main->process();
