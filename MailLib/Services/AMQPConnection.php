<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 02.04.2017
 * Time: 20:16
 */

namespace KaaRabbitTest\Services;

use KaaRabbitTest\config\AMQPConfig;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class AMQPConnection
{
    private static $connection;

    public static function getInstance()
    {
        if (empty(self::$connection)) {
            self::$connection = new AMQPStreamConnection(
                AMQPConfig::HOST,
                AMQPConfig::PORT,
                AMQPConfig::USER,
                AMQPConfig::PASS,
                AMQPConfig::VHOST
            );
        }

        return self::$connection;
    }
}