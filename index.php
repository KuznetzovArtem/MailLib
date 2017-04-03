<?php
require_once "vendor/autoload.php";
$a =  \KaaRabbitTest\QueueManagers\QueueConsumers\MailConsumer::class;
$test = new $a;

$test = new \KaaRabbitTest\QueueManagers\QueueMailManager();
$result = $test->buildChanelByType(\KaaRabbitTest\config\ConsumersConfig::TYPE, 'send_mail_consumer');
if ($result instanceof \KaaRabbitTest\QueueManagers\QueueProducers\ProducersInterface) {
    $result->publish('test');
}
var_dump($result);