<?php
/**
 * Created by PhpStorm.
 * User: �������
 * Date: 04.04.2017
 * Time: 22:32
 */
namespace KaaMailLib\QueueManagers\QueueAdapters;
use KaaMailLib\config\ProducersConfig;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * ����� ��� ������������ �����������
 *
 * Class ProducerAdapter
 * @package KaaMailLib\QueueManagers\QueueAdapters
 */
class ProducerAdapter
{
    /**
     * @var ConsumerAdapter
     */
    private $producersConfig;

    /**
     * @param ProducersConfig $consumersConfig
     */
    public function __construct(ProducersConfig $producersConfig)
    {
        $this->producersConfig = $producersConfig;
    }

    /**
     * ������������ ����������
     *
     * @param $name
     * @param AMQPStreamConnection $connection
     * @return bool|\PhpAmqpLib\Channel\AMQPChannel
     */
    public function �onfigure($name, AMQPStreamConnection $connection)
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