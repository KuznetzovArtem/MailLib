<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 04.04.2017
 * Time: 22:54
 */

namespace KaaMailLib\QueueManagers\QueueConsumers;

use PhpAmqpLib\Message\AMQPMessage;

interface AMQPConsumerInterface
{
    public function consume(AMQPMessage $message);
}