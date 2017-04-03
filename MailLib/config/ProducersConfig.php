<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 02.04.2017
 * Time: 19:13
 */
namespace KaaRabbitTest\config;

use KaaRabbitTest\QueueManagers\QueueConsumers\MailConsumer;
use KaaRabbitTest\QueueManagers\QueueProducers\SendMailErrorLogProducer;
use KaaRabbitTest\QueueManagers\QueueProducers\SendMailProducer;

class ProducersConfig
{
    const TYPE = 'producers';
    protected $producers = [
        'Mail' => [
            'exchange' => SendMailProducer::EXCHANGE,
            'queue_name' => MailConsumer::QUEUE_NAME,
            'type' => 'direct',
            'route' => [SendMailProducer::ROUTE_KEY],
            'callback' => SendMailProducer::class
        ],
        'SendMailErrorLog' => [
            'exchange' => SendMailProducer::EXCHANGE,
            'queue_name' => SendMailErrorLogProducer::QUEUE_NAME,
            'type' => 'direct',
            'route' => [SendMailErrorLogProducer::ROUTE_KEY],
            'callback' => SendMailErrorLogProducer::class
        ]
    ];

    /**
     * @return array
     */
    public function getProducers()
    {
        return $this->producers;
    }


}