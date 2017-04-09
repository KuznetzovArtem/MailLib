<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 04.04.2017
 * Time: 20:38
 */

namespace KaaMailLib\QueueManagers\QueueBuilders;

use KaaMailLib\config\ConsumersConfig;
use KaaMailLib\connections\AMQPConnection;
use KaaMailLib\QueueManagers\QueueAdapters\ConsumerAdapter;
use KaaMailLib\Services\DiSetter;
use PhpAmqpLib\Channel\AMQPChannel;

/**
 * Class ConsumerBuilder
 * @package KaaMailLib\QueueManagers\QueueBuilders
 */
class ConsumerBuilder
{
    use AMQPConnection;
    /**
     * @var ConsumerAdapter
     */
    protected $consumerAdapter;

    /**
     * @var DiSetter
     */
    protected $diSetter;

    /**
     * @param ConsumerAdapter $consumerAdapter
     * @param DiSetter $diSetter
     */
    public function __construct(ConsumerAdapter $consumerAdapter, DiSetter $diSetter)
    {
        $this->consumerAdapter = $consumerAdapter;
        $this->diSetter = $diSetter;
    }

    /**
     * Метод получает сконфигурированного консюмера
     *
     * @param $name
     * @return bool
     */
    public function consume($name)
    {
        $connection = $this->getAMQPConnection();
        $callback = $this->consumerAdapter->getPropertyOfConsumer($name, 'callback');
        $consumer = $this->diSetter->setServicesToClass($callback);
        $channel = $this->consumerAdapter->сonfigure($name, $connection);
        if (!$channel instanceof AMQPChannel) {
            return false;
        }
        $queueName = $this->consumerAdapter->getPropertyOfConsumer($name, 'queue_name');
        $channel->basic_consume($queueName, '', false, false, false, false, [$consumer,'consume']);
        $messageListening = 0;
        while (count($channel->callbacks) && $messageListening < ConsumersConfig::MAXIMAL_MESSAGE) {
            $channel->wait();
            $messageListening++;
        }
        $channel->close();
    }
}
