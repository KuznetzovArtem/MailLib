<?php

/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 05.04.2017
 * Time: 0:11
 */
namespace KaaMailLib\QueueManagers\QueueProducers;
use KaaRabbitTest\QueueManagers\AMQPEntityInterface;
use PhpAmqpLib\Channel\AMQPChannel;

class SendMailProducer implements AMQPEntityInterface
{
    const EXCHANGE_NAME = 'SendMailExchange';
    const MAIL_KEY = 'MustBeSend';
    const ERROR_MAIL_KEY = 'ErrorMustBeSend';

    public function setChanel(AMQPChannel $channel)
    {
        // TODO: Implement setChanel() method.
    }

    public function produce($message)
    {

    }

}