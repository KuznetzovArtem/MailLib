<?php

/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 04.04.2017
 * Time: 20:38
 */
namespace KaaMailLib\QueueManagers\QueueFabrics;
use KaaMailLib\connections\AMQPConnection;
use KaaMailLib\QueueManagers\QueueAdapters\ConsumerAdapter;
use KaaMailLib\config\ConsumersConfig;
use PhpAmqpLib\Channel\AMQPChannel;

/**
 * todo переимновать фабрику в фасад
 * Class ConsumersFabric
 * @package KaaMailLib\QueueManagers\QueueFabrics
 */
class ConsumersFabric
{
    use AMQPConnection;
    /**
     * @var ConsumersConfig
     */
    protected $consumersConfig;
    /**
     * @var ConsumerAdapter
     */
    protected $consumerAdapter;

    public function __construct(ConsumersConfig $consumersConfig,ConsumerAdapter $consumerAdapter)
    {
        $this->consumersConfig = $consumersConfig;
        $this->consumerAdapter = $consumerAdapter;
    }

    /**
     * Метод получает сконфигурированного консюмера
     *
     * @param $name
     * @return bool
     */
    final public function getConsumer($name)
    {
        $consumerConfiguration = $this->consumersConfig->getProducerConfig($name);
        if (! is_array($consumerConfiguration)) {
            return false;
        }
        $conncetion = $this->getAMQPConnection();
        $channel = $this->consumerAdapter->configurate($consumerConfiguration, $conncetion);
        if (! $channel instanceof AMQPChannel) {
            return false;
        }

        return $this->getReadyConsumerByConfigName($name, $channel);
    }

    protected function getReadyConsumerByConfigName($name, AMQPChannel $channel)
    {
        $callback = $this->consumersConfig->getPropertyOfConsumer($name, 'callback');
        if (class_exists($callback)) {
            $consumer = new $callback;
            //todo тут надо засетить в консюмер все сервисы
            $channel->basic_consume($queue_name, '', false, false, false, false, $callback);

            while(count($channel->callbacks)) {
                $a->test->wait();

            }
            $a->test->close();
        }

    }

}