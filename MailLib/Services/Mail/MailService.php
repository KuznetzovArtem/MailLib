<?php
/**
 * Created by PhpStorm.
 * User: �������
 * Date: 03.04.2017
 * Time: 4:18
 */

namespace KaaRabbitTest\Services\Mail;


class MailService
{
    protected $mailValidator;

    public function __construct()
    {
        $this->mailValidator = new MailValidator();
    }
}