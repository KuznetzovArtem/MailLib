<?php

/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 04.04.2017
 * Time: 22:30
 */
namespace KaaMailLib\QueueManagers\QueueAdapters;
use AMQPConnection;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ConsumerAdapter
{
    public function configurate($configuration, AMQPStreamConnection $connection)
    {
        $channel = $connection->channel();

        $channel->queue_declare($configuration['queue_name'], false, true, false, false);

        foreach($configuration['route'] as $severity) {
            $channel->queue_bind($configuration['queue_name'], $configuration['exchange'], $severity);
        }

        return $channel;
    }
}