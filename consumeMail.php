<?php
require_once "vendor/autoload.php";
use KaaMailLib\QueueManagers\QueueBuilders\ConsumerBuilder;
$container = new \KaaMailLib\config\DiConfig();
$container = $container->container;
/**
 * @var ConsumerBuilder $mailService
 */
$mailService = $container->get('ConsumerBuilder');
$mailService->consume(\KaaMailLib\QueueManagers\QueueConsumers\MailConsumer::NAME);