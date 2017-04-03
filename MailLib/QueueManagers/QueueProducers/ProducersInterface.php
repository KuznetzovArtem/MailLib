<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 03.04.2017
 * Time: 1:49
 */

namespace KaaRabbitTest\QueueManagers\QueueProducers;

use PhpAmqpLib\Channel\AMQPChannel;

interface ProducersInterface
{
    public function setChannel(AMQPChannel $chanel);

    public function publish($message);
}