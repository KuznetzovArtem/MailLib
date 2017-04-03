<?php

/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 02.04.2017
 * Time: 19:28
 */
namespace KaaRabbitTest\Services;
use KaaRabbitTest\config\ConsumersConfig;
use KaaRabbitTest\config\ProducersConfig;

class ConfigAdapter
{
    protected $consumersConfig;
    protected $producersConfig;

    public function __construct()
    {
        $this->consumersConfig = new ConsumersConfig();
        $this->producersConfig = new ProducersConfig();
    }

    public function getConfigByType($type)
    {
        switch ($type) {
            case ConsumersConfig::TYPE:
                return $this->consumersConfig->getConsumers();
            case ProducersConfig::TYPE:
                return $this->producersConfig->getProducers();
            default:
                return [];
        }
    }
}