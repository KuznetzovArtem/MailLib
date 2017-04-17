<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 04.04.2017
 * Time: 20:38
 */

namespace KaaMailLib\QueueManagers\QueueBuilders;

use KaaMailLib\connections\AMQPConnection;
use KaaMailLib\QueueManagers\QueueAdapters\ProducerAdapter;
use KaaMailLib\QueueManagers\QueueProducers\Producer;
use PhpAmqpLib\Channel\AMQPChannel;

/**
 * // REVIEW: идея неплохая использовать билдер для создания продюсера, но реализация далека от классического понимания билдера
 * Class ProducerBuilder
 * @package KaaMailLib\QueueManagers\QueueBuilders1
 */
class ProducerBuilder
{
    use AMQPConnection;

    /**
     * @var ProducerAdapter
     */
    protected $producerAdapter;

    /**
     * @param ProducerAdapter $producerAdapter
     */
    public function __construct(ProducerAdapter $producerAdapter)
    {
        $this->producerAdapter = $producerAdapter;
    }

    /**
     * @param $name
     * @return bool|Producer
     */
    public function getProducer($name)
    {
        $connection = $this->getAMQPConnection();

        $chanel = $this->producerAdapter->сonfigure($name, $connection);

        if (!($chanel instanceof AMQPChannel)) {
            return false;
        }

        $callbackName = $this->producerAdapter->getProducerProperty($name, 'callback');
        if (!class_exists($callbackName)) {
            return false;
        }
        $producer = new $callbackName;
        if (!($producer instanceof Producer)) {
            return false;
        }

        $producer->setChannel($chanel);
        return $producer;
    }
}
