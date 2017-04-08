<?php
require_once "vendor/autoload.php";
use KaaMailLib\QueueManagers\QueueBuilders\ConsumerBuilder;
use KaaMailLib\QueueManagers\QueueBuilders\ProducerBuilder;
$container = new \KaaMailLib\config\DiConfig();
$container = $container->container;
/**
 * @var ConsumerBuilder $mailService
 */
$mailService = $container->get('ConsumerBuilder');
$mailService->consume(\KaaMailLib\QueueManagers\QueueConsumers\MailErrorConsumer::NAME);