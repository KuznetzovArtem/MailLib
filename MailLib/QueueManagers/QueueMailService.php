<?php
/**
 * Created by PhpStorm.
 * User: �������
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
     * ������� ��� �������� ���������
     *
     * @var
     */
    protected $consumersFabric;

    /**
     * ������� ��� �������� ����������
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
     * ����� ��� ��������� ������������������� ���������
     *
     * @var string $name
     * @param $name
     * @return ������ ������� ������ ���������
     */
    public function getConsumerByName($name)
    {


    }

    /**
     * ����� ��� ��������� ������������������� ����������
     *
     * @var string $name
     * @param $settings
     * @return ������ ������� ������ ����������
     */
    private function getProducerByName($name)
    {

    }
}