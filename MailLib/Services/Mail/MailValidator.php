<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 03.04.2017
 * Time: 4:22
 */

namespace KaaMailLib\Services\Mail;

use KaaMailLib\QueueManagers\QueueBuilders\ProducerBuilder;
use KaaMailLib\QueueManagers\QueueProducers\SendMailProducer;

/**
 * Класс валидации сообщений для отправки
 *
 * Class MailValidator
 * @package KaaMailLib\Services\Mail
 */
class MailValidator
{
    /**
     * @var bool|\KaaMailLib\QueueManagers\QueueProducers\Producer
     */
    private $sendMailProducer;

    public function __construct(ProducerBuilder $producerBuilder)
    {
        $this->sendMailProducer = $producerBuilder->getProducer(SendMailProducer::NAME);
    }

    /**
     * Проверка сообщения на корректность
     *
     * @param $message
     * @return bool
     */
    public function validate($message)
    {
        if (
            !is_array($message) ||
            !array_key_exists('From', $message) ||
            !array_key_exists('To', $message) ||
            !array_key_exists('Theme', $message)
        ) {
            $this->sendErrorMessage($message);
            return false;
        }
        return true;
    }

    /**
     * Отправлят сообщени об ошибке
     *
     * @param $message
     */
    private function sendErrorMessage($message)
    {
        $errorMessage = $this->createErrorMessage($message);
        $this->sendMailProducer->send($errorMessage, SendMailProducer::ERROR_MAIL_KEY);
    }

    /**
     * Формирует сообщение об ошибке
     *
     * @param $message
     * @return array
     */
    private function createErrorMessage($message)
    {
        $errorMessageText = '';
        if (is_array($message)) {
            foreach ($message as $fieldName => $fieldValue) {
                $errorMessageText .= $fieldName . ': ' . $fieldValue . "\n";
            }
        } else {
            $errorMessageText .= $message;
        }

        return [
            'From' => 'system',
            'To' => 'admin',
            'Theme' => 'Incorrect Message',
            'Text' => $errorMessageText
        ];
    }
}
