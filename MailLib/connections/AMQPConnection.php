<?php

/**
 * Created by PhpStorm.
 * User: Êóçíåöî
 * Date: 04.04.2017
 * Time: 20:48
 */
namespace KaaMailLib\connections;
use KaaMailLib\config\AMQPConfig;
use PhpAmqpLib\Connection\AMQPStreamConnection;

trait AMQPConnection
{
    public function getAMQPConnection()
    {
        try {
            return new AMQPStreamConnection(
                AMQPConfig::HOST,
                AMQPConfig::PORT,
                AMQPConfig::USER,
                AMQPConfig::PASS,
                AMQPConfig::VHOST
            );
        } catch (ErrorException $a){
            $a->getMessage();
        }
    }
}