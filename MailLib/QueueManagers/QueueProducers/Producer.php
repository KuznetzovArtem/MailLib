<?php
/**
 * Created by PhpStorm.
 * User: �������
 * Date: 08.04.2017
 * Time: 20:12
 */

namespace KaaMailLib\QueueManagers\QueueProducers;

use PhpAmqpLib\Channel\AMQPChannel;

/**
 * �� ���� ��� ����������� ������� ����������� �� �� ������ 1
 *
 * Class Producer
 * @package KaaMailLib\QueueManagers\QueueProducers
 */
abstract class Producer
{
    /**
     * @var AMQPChannel
     */
    protected $channel;

    /**
     * @param AMQPChannel $channel
     * @return mixed
     */
    abstract public function setChannel(AMQPChannel $channel);

    /**
     * ����� �������� ���������
     *
     * @param $message
     * @param $key
     * @return mixed
     */
    abstract public function send($message, $key);

    public function __destruct()
    {
        $this->channel->close();
    }
}