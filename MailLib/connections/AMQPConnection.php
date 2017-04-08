<?php

/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 04.04.2017
 * Time: 20:48
 */
namespace KaaMailLib\connections;

use KaaMailLib\config\AMQPConfig;
use PhpAmqpLib\Connection\AMQPStreamConnection;

trait AMQPConnection
{
    /**
     * Объейк подключения к рэбиту
     *
     * @var AMQPStreamConnection
     */
    protected static $connection;

    /**
     * Метод для получения подключения к рэббиту
     *
     * @return AMQPStreamConnection
     */
    public function getAMQPConnection()
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