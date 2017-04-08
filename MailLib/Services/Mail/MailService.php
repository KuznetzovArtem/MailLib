<?php
/**
 * Created by PhpStorm.
 * User: �������
 * Date: 03.04.2017
 * Time: 4:18
 */

namespace KaaMailLib\Services\Mail;

/**
 * ������ ��� �������� ���������
 *
 * Class MailService
 * @package KaaMailLib\Services\Mail
 */
class MailService
{
    /**
     * ������ �������� ��������� �� ������������
     *
     * @var MailValidator
     */
    protected $mailValidator;

    public function __construct($mailValidator)
    {
        $this->mailValidator = $mailValidator;
    }

    /**
     * ���������� �������� �� �����
     *
     * @param $message
     */
    public function sendMail($message)
    {
        $correctMessage = $this->mailValidator->validate($message);
        if (!$correctMessage) {
            return;
        }
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: <" . $message['From'] . ">" . "\r\n";
        mail($message['To'], $message['subject'], $message['text'], $headers);
    }
}