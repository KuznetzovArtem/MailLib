<?php

/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 02.04.2017
 * Time: 17:18
 */
namespace KaaRabbitTest\QueueManagers\QueueProducers;

use PhpAmqpLib\Channel\AMQPChannel;

class SendMailErrorLogProducer implements ProducersInterface
{
    const QUEUE_NAME = 'mail_error_log';
    const ROUTE_KEY = 'send_error';

    protected $chanel;

    public function setChannel(AMQPChannel $chanel)
    {
        $this->chanel = $chanel;
    }

    public function publish($message)
    {
        echo 'ok';
        exit();
        // TODO: Implement publish() method.
    }


}