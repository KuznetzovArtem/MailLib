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

class QueueMailService
{
    /**
     * Фабрика для создания консюмера
     *
     * @var
     */
    protected $consumersFabric;

    /**
     * Фабрика для создания продюссера
     *
     * @var
     */
    protected $producerFabric;

    public function __construct($consumersFabric, $producerFabric)
    {
        $this->consumersFabric = $consumersFabric;
        $this->producerFabric = $producerFabric;
    }

    /**
     * Метод для получения сконфигурированного консюмера
     *
     * @var string $name
     * @param $name
     * @return должен вернуть объект консюмера
     */
    public function getConsumerByName($name)
    {


    }

    /**
     * Метод для получения сконфигурированного продюссера
     *
     * @var string $name
     * @param $settings
     * @return должен вернуть объект продюссера
     */
    private function getProducerByName($name)
    {

    }
}