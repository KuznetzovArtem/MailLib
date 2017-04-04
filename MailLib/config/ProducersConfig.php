<?php
/**
 * Created by PhpStorm.
 * User: �������
 * Date: 02.04.2017
 * Time: 19:13
 */
namespace KaaMailLib\config;

use KaaRabbitTest\QueueManagers\QueueConsumers\MailConsumer;
use KaaRabbitTest\QueueManagers\QueueProducers\SendMailErrorLogProducer;
use KaaRabbitTest\QueueManagers\QueueProducers\SendMailProducer;

class ProducersConfig
{
    const TYPE = 'producers';
    /**
     * ������ ����������� � �� �����������
     *
     * @var array
     */
    protected $producers = [
        'Mail' => [

        ],
    ];

    /**
     * ����� ��� ��������� ������������ ����������
     *
     * @return array
     */
    public function getProducerConfig($name)
    {
        if (array_key_exists($name, $this->consumers)) {
            return $this->consumers[$name];
        } else {
            return false;
        }
    }


}