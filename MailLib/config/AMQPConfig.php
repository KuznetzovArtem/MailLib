<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 02.04.2017
 * Time: 19:13
 */
namespace KaaMailLib\config;

// REVIEW: непонятно почему это абстрактный класс, если уж описывать конфиги в классах, то думаю
// REVIEW: лучше делать их финальными через final class, чтобы нельзя было отнаследовать и изменить
abstract class AMQPConfig
{
    const HOST = '192.168.99.100';
    const PORT = '8070';
    const USER = 'guest';
    const PASS = 'guest';
    const VHOST = '/';
}

