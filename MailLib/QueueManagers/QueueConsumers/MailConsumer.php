<?php

/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 02.04.2017
 * Time: 17:17
 */
namespace KaaRabbitTest\QueueManagers\QueueConsumers;
use PhpAmqpLib\Message\AMQPMessage;

class MailConsumer implements ConsumersInterface
{
    const QUEUE_NAME = 'send_mail';

    public function __construct()
    {

    }
    public function consume(AMQPMessage $message)
    {
        $mail = json_decode($message->body, true);
        $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);

        // TODO: Implement consume() method.
    }

}