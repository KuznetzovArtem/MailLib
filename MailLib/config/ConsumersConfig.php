<?php

namespace KaaMailLib\config;


use KaaMailLib\QueueManagers\QueueConsumers\MailConsumer;
use KaaMailLib\QueueManagers\QueueProducers\SendMailProducer;

class ConsumersConfig
{
    /**
     * Список консюмеров с их настройками
     *
     * @var array
     */
    protected $consumers = [
         MailConsumer::NAME =>[
             'queue_name' => MailConsumer::QUEUE_NAME,
             'type' => 'direct',
             'exchange' => SendMailProducer::EXCHANGE_NAME,
             'route' => [SendMailProducer::MAIL_KEY],
             'callback' => MailConsumer::class
         ]
    ];

    /**
     * Метод для получения конфигурации консюмера
     *
     * @return array
     */
    public function getConsumerConfig($name)
    {
        if (array_key_exists($name, $this->consumers)) {
            return $this->consumers[$name];
        } else {
            return false;
        }
    }

    public function getPropertyOfConsumer($name, $property)
    {
        if (array_key_exists($name, $this->consumers) && array_key_exists($property, $this->consumers[$name])) {
            return $this->consumers[$name][$property];
        }
        return false;
    }

}
