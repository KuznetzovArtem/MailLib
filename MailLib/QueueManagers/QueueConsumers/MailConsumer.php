<?php
/**
 * Created by PhpStorm.
 * User: �������
 * Date: 04.04.2017
 * Time: 21:24
 */

namespace KaaMailLib\QueueManagers\QueueConsumers;

use KaaMailLib\Services\Mail\MailService;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * ������ ��� �������� ���������
 *
 * Class MailConsumer
 */
class MailConsumer implements AMQPConsumerInterface
{
    const NAME = 'Mail';
    const QUEUE_NAME = 'Send_Mail';

    /**
     * ������ ��� �������� ���������
     *
     * @var MailService
     */
    private $mailService;

    /**
     * @param MailService $mailService
     */
    public function setMailService($mailService)
    {
        $this->mailService = $mailService;
    }

    public function consume(AMQPMessage $message)
    {
        $body = json_decode($message->body,true);
        $this->mailService->sendMail($body);
        var_dump($body);
        //todo ��� ����� �� ��������� ���������
        $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
    }

}