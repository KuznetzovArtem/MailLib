<?php
/**
 * Created by PhpStorm.
 * User: �������
 * Date: 03.04.2017
 * Time: 0:22
 */

namespace KaaRabbitTest\QueueManagers\QueueConsumers;


use PhpAmqpLib\Message\AMQPMessage;

interface ConsumersInterface
{
    public function consume(AMQPMessage $message);
}