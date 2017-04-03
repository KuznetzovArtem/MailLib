<?php

namespace KaaRabbitTest\config;


use KaaRabbitTest\QueueManagers\QueueConsumers\MailConsumer;
use KaaRabbitTest\QueueManagers\QueueConsumers\SendMailErrorLogConsumer;

class ConsumersConfig
{
    const TYPE = 'consumers';
    protected $consumers = [
        'error_message_consumer' => [
            'queue_name' => SendMailErrorLogConsumer::ERROR_MAIL_LOG_QUEUE,
            'callback' => SendMailErrorLogConsumer::class
        ],
        'send_mail_consumer' => [
            'queue_name' => MailConsumer::QUEUE_NAME,
            'callback' => MailConsumer::class
        ],
    ];

    /**
     * @return array
     */
    public function getConsumers()
    {
        return $this->consumers;
    }

}
