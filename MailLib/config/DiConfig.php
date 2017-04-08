<?php
/**
 * Created by PhpStorm.
 * User: �������
 * Date: 08.04.2017
 * Time: 22:12
 */

namespace KaaMailLib\config;

use KaaMailLib\config\ConsumersConfig;
use KaaMailLib\QueueManagers\QueueAdapters\ConsumerAdapter;
use Symfony\Component\DependencyInjection\Reference;
use KaaMailLib\Services\Mail\MailValidator;
use KaaMailLib\Services\Mail\MailService;
use KaaMailLib\QueueManagers\QueueBuilders\ConsumerBuilder;
use KaaMailLib\Services\DiSetter;
use KaaMailLib\QueueManagers\QueueBuilders\ProducerBuilder;
use KaaMailLib\QueueManagers\QueueAdapters\ProducerAdapter;

/**
 * � ������ ����������� �����������
 *
 * Class DiConfig
 * @package KaaMailLib
 */
class DiConfig
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    public $container;


    public function __construct()
    {
        $container  = new \Symfony\Component\DependencyInjection\ContainerBuilder();
        // ������������ ���������
        $container->register('ConsumerBuilder', ConsumerBuilder::class)
            ->addArgument(new Reference('ConsumerAdapter'))
            ->addArgument(new Reference('DiSetter'));
        $container->register('ConsumerAdapter', ConsumerAdapter::class)
            ->addArgument(new Reference('ConsumersConfig'));
        $container->register('ConsumersConfig', ConsumersConfig::class);

        // ������������ ����������
        $container->register('ProducerBuilder', ProducerBuilder::class)
            ->addArgument(new Reference('ProducerAdapter'));
        $container->register('ProducerAdapter', ProducerAdapter::class)
            ->addArgument(new Reference('ProducersConfig'));
        $container->register('ProducersConfig', ProducersConfig::class);

        // ������������ ������� ������� ����� ���������� ������ �������
        $container->register('DiSetter',  DiSetter::class)
            ->addMethodCall('setContainer', array(new Reference('service_container')));


        // ����������� ������� ��� �������� ���������
        $container->register('MailValidator', MailValidator::class)
            ->addArgument(new Reference('ProducerBuilder'));
        $container->register('MailService', MailService::class)
            ->addArgument(new Reference('MailValidator'));
        $this->container = $container;
    }
}
