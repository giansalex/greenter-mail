<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 20/02/2018
 * Time: 05:57 PM
 */

namespace Tests\Greenter\Mail;

use Greenter\Mail\MailNotificator;
use Greenter\Notify\Notification;

class MailNotificatorTest extends \PHPUnit_Framework_TestCase
{
    public function testNotification()
    {
        $mail = new MailNotificator();

        $mail->notify(new Notification());

        $this->assertTrue(true);
    }
}