<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 04.04.2017
 * Time: 22:32
 */

namespace KaaMailLib\QueueManagers\QueueAdapters;
use KaaMailLib\config\ProducersConfig;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * // REVIEW: на самом деле класс занимается совсем другим. Посмотри внимательно свой код и скажи что он делает.
 * Класс для конфигурации продюссеров
 *
 * Class ProducerAdapter
 * @package KaaMailLib\QueueManagers\QueueAdapters
 */
class ProducerAdapter
{
    /**
     * // REVIEW: здесь скорее всего не ConsumerAdapter, а ProducersConfig, думаю просто опечатался
     * @var ConsumerAdapter
     */
    private $producersConfig;

    /**
     * // REVIEW: здесь тоже название переменной не соответствует тому, что действительно передается в аргументах
     * @param ProducersConfig $consumersConfig
     */
    public function __construct(ProducersConfig $producersConfig)
    {
        $this->producersConfig = $producersConfig;
    }

    /**
     * Конфигурация продюссера
     *
     * @param $name
     * @param AMQPStreamConnection $connection
     * @return bool|\PhpAmqpLib\Channel\AMQPChannel
     */
    public function сonfigure($name, AMQPStreamConnection $connection)
    {
        $configuration = $this->producersConfig->getProducerConfig($name);
        if (!is_array($configuration)) {
            return false;
        }
        $channel = $connection->channel();
        $channel->exchange_declare($configuration['exchange'], $configuration['type'], false, false, false);
        return $channel;
    }

    public function getProducerProperty($name, $property)
    {
        return $this->producersConfig->getProducerProperty($name, $property);
    }
}
