<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 04.04.2017
 * Time: 22:54
 */

namespace KaaMailLib\QueueManagers;


use PhpAmqpLib\Channel\AMQPChannel;

interface AMQPEntityInterface
{
    public function setChanel(AMQPChannel $channel);
}