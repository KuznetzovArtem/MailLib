<?php
/**
 * Created by PhpStorm.
 * User: �������
 * Date: 02.04.2017
 * Time: 19:13
 */
namespace KaaMailLib\config;

use KaaMailLib\QueueManagers\QueueProducers\SendMailProducer;

/**
 * ������������ �����������
 *
 * Class ProducersConfig
 * @package KaaMailLib\config
 */
class ProducersConfig
{
    const TYPE = 'producers';
    /**
     * ������ ����������� � �� �����������
     *
     * @var array
     */
    protected $producers = [
        SendMailProducer::NAME => [
            'exchange' => SendMailProducer::EXCHANGE_NAME,
            'type' => 'direct',
            'route' => [SendMailProducer::MAIL_KEY, SendMailProducer::ERROR_MAIL_KEY],
            'callback' => SendMailProducer::class
        ],
    ];

    /**
     * ����� ��� ��������� ������������ ����������
     *
     * @return array
     */
    public function getProducerConfig($name)
    {
        if (array_key_exists($name, $this->producers)) {
            return $this->producers[$name];
        } else {
            return false;
        }
    }

    /**
     * @param $name
     * @param $property
     * @return bool
     */
    public function getProducerProperty($name, $property)
    {
        if (array_key_exists($name, $this->producers) && array_key_exists($property, $this->producers[$name])) {
            return $this->producers[$name][$property];
        }
        return false;
    }
}