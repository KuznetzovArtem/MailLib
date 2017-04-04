<?php

/**
 * Created by PhpStorm.
 * User: �������
 * Date: 04.04.2017
 * Time: 21:24
 */

/**
 * ������ ��� �������� ���������
 *
 * Class MailConsumer
 */

namespace KaaMailLib\QueueManagers\QueueConsumers;
use \AMQPChannel;
use KaaMailLib\QueueManagers\AMQPEntityInterface;
use PhpAmqpLib\Message\AMQPMessage;

class MailConsumer implements AMQPEntityInterface
{
    const NAME = 'Mail';
    const QUEUE_NAME = 'Send_Mail';

    /**
     * ������ ��� ���������� ��������� � ��������
     *
     * @var
     */
    private $publisher;

    /**
     * ������ ��� �������� ���������
     *
     * @var
     */
    private $mailService;

    /**
     * @var AMQPChannel
     */
    private $channel;

    /**
     * @param mixed $publisher
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
    }

    public function setChanel(AMQPChannel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * @param mixed $mailService
     */
    public function setMailService($mailService)
    {
        $this->mailService = $mailService;
    }

    public function consume(AMQPMessage $message)
    {
        //todo ��� ����� �� ��������� ���������
        echo ' [x] ',$msg->delivery_info['routing_key'], ':', $msg->body, "\n";
        $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
    }

}