use amqp::{Options, Session, Basic, Table, AMQPScheme};
use std::env;
use std::time::{Instant};

fn main() {
    let start = Instant::now();

    let options = Options {
        host: env!("RABBIT_HOST").to_string(),
        port: env!("RABBIT_PORT").parse().unwrap(),
        vhost: env!("RABBIT_VHOST").to_string(),
        login: env!("RABBIT_USER").to_string(),
        password: env!("RABBIT_PASS").to_string(),
        frame_max_limit: 131072,
        channel_max_limit: 65535,
        locale: "en_US".to_string(),
        scheme: AMQPScheme::AMQP,
        properties: Table::new(),
    };

    let mut session = match Session::new(Options { .. options }){
        Ok(session) => session,
        Err(error) => panic!("Failed openning an amqp session: {:?}", error)
    };
    let mut channel = match session.open_channel(1){
        Ok(channel) => channel,
        Err(error) => panic!("Failed openning channel: {:?}", error)
    };

    match channel.queue_declare("queue_rust", false, true, false, false, false, Table::new()) {
        Ok(channel) => channel,
        Err(error) => panic!("Failed openning channel: {:?}", error)
    };

    let mut i = 1;

    while i <= env!("REPEAT_COUNT").parse().unwrap() {
        match channel.basic_publish(
            "",
            "queue_rust",
            true,
            false,
            amqp::protocol::basic::BasicProperties{
                content_type: Some("text".to_string()), .. Default::default()
            }, (env!("MESSAGE")).as_bytes().to_vec()) {
                Ok(channel) => channel,
                Err(error) => panic!("Failed openning channel: {:?}", error)
        };

        i = i +1;
    }

    let duration = start.elapsed();

    println!("Time elapsed in expensive_function() is: {:?}", duration);

}


