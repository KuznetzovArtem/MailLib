<?php

/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 04.04.2017
 * Time: 20:38
 */
namespace KaaMailLib\QueueManagers\QueueFabrics;
use KaaMailLib\config\ProducersConfig;
use KaaMailLib\connections\AMQPConnection;
use KaaMailLib\QueueManagers\QueueAdapters\ProducerAdapter;
use PhpAmqpLib\Channel\AMQPChannel;

/**
 * todo переимновать фабрику в фасад
 *
 * Class ProducersFabric
 * @package KaaMailLib\QueueManagers\QueueFabrics1
 */
class ProducersFabric
{
    use AMQPConnection;

    /**
     * @var ProducersConfig
     */
    protected $producersConfig;

    /**
     * @var ProducerAdapter
     */
    protected $producerAdapter;

    /**
     * @param ProducersConfig $producersConfig
     * @param ProducerAdapter $producerAdapter
     */
    public function __construct(ProducersConfig $producersConfig,ProducerAdapter $producerAdapter)
    {
        $this->producersConfig = $producersConfig;
        $this->producerAdapter = $producerAdapter;
    }

    /**
     * Метод для получения продюссера
     *
     * @param $name
     * @return bool
     */
    final public function getProducer($name)
    {
        $producerConfiguration = $this->producersConfig->getProducerConfig($name);
        if (! is_array($producerConfiguration)) {
            return false;
        }
        $conncetion = $this->getAMQPConnection();
        $chanel = $this->producerAdapter->configurate($producerConfiguration, $conncetion);
        if (! $chanel instanceof AMQPChannel) {
            return false;
        }

        return $this->getReadyProducerByConfigName($name, $chanel);
    }

    protected function getReadyProducerByConfigName($name, AMQPChannel $chanel)
    {


        return true;
    }
}