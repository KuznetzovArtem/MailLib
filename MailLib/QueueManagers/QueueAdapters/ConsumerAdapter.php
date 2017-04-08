<?php

/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 04.04.2017
 * Time: 22:30
 */
namespace KaaMailLib\QueueManagers\QueueAdapters;
use KaaMailLib\config\ConsumersConfig;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * Класс для конфигурации консюмеров
 *
 * Class ConsumerAdapter
 * @package KaaMailLib\QueueManagers\QueueAdapters
 */
class ConsumerAdapter
{
    /**
     * @var ConsumerAdapter
     */
    private $consumersConfig;

    /**
     * @param ConsumersConfig $consumersConfig
     */
    public function __construct(ConsumersConfig $consumersConfig)
    {
        $this->consumersConfig = $consumersConfig;
    }

    /**
     * Конфигурация консюмера
     *
     * @param $name
     * @param AMQPStreamConnection $connection
     * @return bool|\PhpAmqpLib\Channel\AMQPChannel
     */
    public function сonfigure($name, AMQPStreamConnection $connection)
    {
        $configuration = $this->consumersConfig->getConsumerConfig($name);
        if (!is_array($configuration)) {
            return false;
        }
        $channel = $connection->channel();
        $channel->exchange_declare($configuration['exchange'], $configuration['type'], false, false, false);
        $channel->queue_declare($configuration['queue_name'], false, true, false, false);
        if (array_key_exists('route', $configuration)) {
            foreach($configuration['route'] as $severity) {
                $channel->queue_bind($configuration['queue_name'], $configuration['exchange'], $severity);
            }
        }
        $channel->queue_bind($configuration['queue_name'], $configuration['exchange']);
        return $channel;
    }

    public function getPropertyOfConsumer($name, $property)
    {
        return $this->consumersConfig->getPropertyOfConsumer($name, $property);
    }
}