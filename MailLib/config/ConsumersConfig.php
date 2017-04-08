<?php
namespace KaaMailLib\config;

use KaaMailLib\QueueManagers\QueueConsumers\MailConsumer;
use KaaMailLib\QueueManagers\QueueConsumers\MailErrorConsumer;
use KaaMailLib\QueueManagers\QueueProducers\SendMailProducer;

/**
 * ������������ �����������
 *
 * Class ConsumersConfig
 * @package KaaMailLib\config
 */
class ConsumersConfig
{
    /**
     * ������������ ���������� �������������� ���������
     */
    const MAXIMAL_MESSAGE = 10;

    /**
     * ������ ���������� � �� �����������
     *
     * @var array
     */
    protected $consumers = [
        MailConsumer::NAME =>[
            'queue_name' => MailConsumer::QUEUE_NAME,
            'type' => 'direct',
            'exchange' => SendMailProducer::EXCHANGE_NAME,
            'route' => [SendMailProducer::MAIL_KEY],
            'callback' => MailConsumer::class
        ],
        MailErrorConsumer::NAME =>[
            'queue_name' => MailErrorConsumer::QUEUE_NAME,
            'type' => 'direct',
            'exchange' => SendMailProducer::EXCHANGE_NAME,
            'route' => [SendMailProducer::ERROR_MAIL_KEY],
            'callback' => MailErrorConsumer::class
        ]

    ];

    /**
     * ����� ��� ��������� ������������ ���������
     *
     * @return array
     */
    public function getConsumerConfig($name)
    {
        if (array_key_exists($name, $this->consumers)) {
            return $this->consumers[$name];
        } else {
            return false;
        }
    }

    /**
     * ����� ��� ��������� �������� �� ������ ��������
     *
     * @param $name
     * @param $property
     * @return bool
     */
    public function getPropertyOfConsumer($name, $property)
    {
        if (array_key_exists($name, $this->consumers) && array_key_exists($property, $this->consumers[$name])) {
            return $this->consumers[$name][$property];
        }
        return false;
    }

}
