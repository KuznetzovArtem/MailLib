<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 03.04.2017
 * Time: 0:19
 */

namespace KaaRabbitTest\Services;


use KaaRabbitTest\config\ConsumersConfig;
use KaaRabbitTest\config\ProducersConfig;

class AMQPConfigValidator
{
    public function validateByType($type, $settings)
    {
        switch ($type) {
            case ConsumersConfig::TYPE:
                return $this->consumerValidation($settings);
            case ProducersConfig::TYPE:
                return $this->producerValidation($settings);
            default:
                return false;
        }
    }

    protected function consumerValidation($settings)
    {

        if (
            !$this->baseValidation($settings)
        ) {
            return false;
        }
        return true;
    }

    protected function baseValidation($settings)
    {
        if (
            !array_key_exists('queue_name', $settings) ||
            !array_key_exists('callback', $settings) ||
            !class_exists($settings['callback'])
        ) {
            return false;
        }
        return true;
    }

    protected function producerValidation($settings)
    {
        if (
            !$this->baseValidation($settings) ||
            !array_key_exists('type', $settings) ||
            !array_key_exists('exchange', $settings)
        ) {
            return false;
        }
        return true;
    }
}