<?php
require_once "vendor/autoload.php";

use KaaMailLib\QueueManagers\QueueBuilders\ProducerBuilder;

// REVIEW: название переменной не соответствует тому, что хранит. У тебя и класс называется как DiConfig, а сохраняешь как будто бы контейнер.
$container = new \KaaMailLib\config\DiConfig();
$container = $container->container;
/**
 * @var ProducerBuilder $mailService
 */
// REVIEW: непонятно почему опять вместо $producerBuilder ты называешь переменную $mailService
$mailService = $container->get('ProducerBuilder');
// REVIEW: нет проверки, на то, что действительно вернул метод getProducer. В самом коде внутри есть вероятность отправить false, здесь никак не обрабатывается.
// REVIEW: а вообще было бы гораздо удобнее работать со своими собственными исключениями
$producer = $mailService->getProducer(\KaaMailLib\QueueManagers\QueueProducers\SendMailProducer::NAME);
$producer->send('testMail',\KaaMailLib\QueueManagers\QueueProducers\SendMailProducer::MAIL_KEY);
