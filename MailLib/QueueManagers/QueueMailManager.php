<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 02.04.2017
 * Time: 19:16
 */
namespace KaaRabbitTest\QueueManagers;

use KaaRabbitTest\QueueManagers\QueueConsumers\ConsumersInterface;
use KaaRabbitTest\QueueManagers\QueueProducers\ProducersInterface;
use KaaRabbitTest\Services\AMQPConfigValidator;
use KaaRabbitTest\Services\AMQPConnection;
use KaaRabbitTest\Services\ConfigAdapter;

class QueueMailManager
{
    /**
     * @var
     */
    protected $configAdapter;
    /**
     * @var
     */
    protected $amqpConfigValidator;

    public function __construct()
    {
        $this->configAdapter = new ConfigAdapter();
        $this->amqpConfigValidator =  new AMQPConfigValidator();
    }

    /**
     * @param $type
     * @param $name
     * @return bool|null|ProducerInterface
     */
    public function buildChanelByType($type, $name)
    {
        $settingsArray = $this->configAdapter->getConfigByType($type);
        if (!array_key_exists($name, $settingsArray)) {
            return null;
        }

        $chanelSetting = $settingsArray[$name];
        if (!$this->amqpConfigValidator->validateByType($type, $chanelSetting)) {
            return false;
        }
        return $this->createChanel($chanelSetting);
    }

    /**
     * @param $settings
     * @return bool|ProducerInterface
     */
    private function createChanel($settings)
    {
        $connection = AMQPConnection::getInstance();
        $channel = $connection->channel();
        $callback = new $settings['callback'];

        if ($callback instanceof ConsumersInterface) {
            $channel->basic_consume($settings['queue_name'], '', false, false, false, false, [$callback, 'consume']);
            while(count($channel->callbacks)) {
                $channel->wait();
            }

            $channel->close();
            return true;
        } elseif ($callback instanceof ProducersInterface) {
            $channel->exchange_declare($settings['exchange'], $settings['type'], false, false, false);
            $channel->queue_declare($settings['queue_name'], false, false, false, false);
            foreach($settings['route'] as $rout) {
                $channel->queue_bind($settings['queue_name'], $settings['exchange'], $rout);
            }
            $callback->setChannel($channel);
            return $callback;
        }
        return false;
    }
}