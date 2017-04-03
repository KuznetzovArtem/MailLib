<?php

/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 02.04.2017
 * Time: 17:17
 */
namespace KaaRabbitTest\QueueManagers\QueueProducers;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;

class SendMailProducer implements ProducersInterface
{
    const EXCHANGE = 'mail_exchange';
    const ROUTE_KEY = 'send';
    /**
     * @var AMQPChannel $chanel
     */
    protected $chanel;
    public function setChannel(AMQPChannel $chanel)
    {
        $this->chanel = $chanel;
    }

    public function publish($message)
    {
        $messageAMQP = new AMQPMessage(json_encode($message));
        $this->chanel->basic_publish($messageAMQP, 'mail_exchange', 'send');

        $this->chanel->close();
        // TODO: Implement publish() method.
    }
}