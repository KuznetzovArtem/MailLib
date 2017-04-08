<?php

/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 05.04.2017
 * Time: 0:11
 */
namespace KaaMailLib\QueueManagers\QueueProducers;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Записывает сообщения в очередь
 *
 * Class SendMailProducer
 * @package KaaMailLib\QueueManagers\QueueProducers
 */
class SendMailProducer extends Producer
{
    const NAME = 'MailProducer';
    const EXCHANGE_NAME = 'SendMailExchange';
    const MAIL_KEY = 'MustBeSend';
    const ERROR_MAIL_KEY = 'ErrorMustBeSend';

    public function setChannel(AMQPChannel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * Отправка сообщения
     *
     * @param $message
     * @param $key
     */
    public function send($message, $key)
    {
        $message = new AMQPMessage(json_encode($message));

        $this->channel->basic_publish($message, self::EXCHANGE_NAME, $key);
    }
}