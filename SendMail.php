<?php
require_once "vendor/autoload.php";

use KaaMailLib\QueueManagers\QueueBuilders\ProducerBuilder;

$container = new \KaaMailLib\config\DiConfig();
$container = $container->container;
/**
 * @var ProducerBuilder $mailService
 */
$mailService = $container->get('ProducerBuilder');
$producer = $mailService->getProducer(\KaaMailLib\QueueManagers\QueueProducers\SendMailProducer::NAME);
$producer->send('testMail',\KaaMailLib\QueueManagers\QueueProducers\SendMailProducer::MAIL_KEY);
