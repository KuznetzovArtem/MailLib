<?php

/**
 * Created by PhpStorm.
 * User: �������
 * Date: 04.04.2017
 * Time: 20:48
 */
namespace KaaMailLib\connections;

use KaaMailLib\config\AMQPConfig;
use PhpAmqpLib\Connection\AMQPStreamConnection;

trait AMQPConnection
{
    /**
     * ������ ����������� � ������
     *
     * @var AMQPStreamConnection
     */
    protected static $connection;

    /**
     * ����� ��� ��������� ����������� � �������
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