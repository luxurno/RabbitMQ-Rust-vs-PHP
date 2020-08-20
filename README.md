### Created for check speed performance for Producer between following libraries:
#### PHP/amqplib
https://github.com/php-amqplib/php-amqplib

#### Rust/amqp
https://crates.io/crates/amqp

### Setting up environment
###### Copy env file
cp .env.dist .env

###### Build container
docker-compose build

###### Install PHP dependencies (in container)
composer install

###### Install Rust dependencies (in container)
cd rust/ && cargo install --path .

###### Compile Rust code (in container)
cd rust/ && cargo build --release

#### Running docker container
docker-compose up -d

#### Stopping docker container
docker-compose down

#### Running bash into App container
docker-compose exec app bash

#### Running bash into Rabbit container
docker-compose exec rabbit bash

#### PHP producer run-up
php php/index.php

#### Rust producer run-up
cd rust/ && cargo run --release release


