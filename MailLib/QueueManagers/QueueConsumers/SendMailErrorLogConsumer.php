<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 02.04.2017
 * Time: 19:02
 */

namespace KaaRabbitTest\QueueManagers\QueueConsumers;


use PhpAmqpLib\Message\AMQPMessage;

class SendMailErrorLogConsumer implements ConsumersInterface
{
    const ERROR_MAIL_LOG_QUEUE = 'error_message_mail';
    public function consume(AMQPMessage $message)
    {
        var_dump($message->body);
        $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);

    }

}