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

use Greenter\Mail\MailServer;
use Greenter\Mail\MailEmail;
use Greenter\Mail\Config\ConfigGmail;

class MailNotificatorTest extends \PHPUnit_Framework_TestCase{

    public function testNotification(){

    	$options = [
    		'SMTPDebug' => 2,
    		'isSMTP' => true,
    		'Host' => 'smtp.gmail.com',
    		'SMTPAuth' => true,
    		'Username' => 'correo',
    		'Password' => 'clave',
    		'SMTPSecure' => 'tls',
    		'Port' => 587
    	];

    	$mailServer = new MailServer($options, MailServer::DEBUG);
        $mailServer->setSender(new MailEmail('correo', 'CORREO PRUEBA'));
        $mailServer->setSubject('Documento electrónico emitido por Nombre Empresa SAC');
        $mailServer->setReceipt(new MailEmail('Appee1975@dayrep.com', 'CORREO PRUEBA')); //fakemailgenerator.com

        $mail = new MailNotificator($mailServer);

        $mail->notify(new Notification());

        $this->assertTrue(true);
    }
}

/*$test = new MailNotificatorTest();
$test->testNotification();*/