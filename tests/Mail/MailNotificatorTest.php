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

use Greenter\Data\StoreTrait;

use Greenter\See;
use Greenter\Ws\Services\SunatEndpoints;
use Greenter\Validator\XmlErrorCodeProvider;

/*use Greenter\Model\Sale\Document;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;*/

use Greenter\Mail\MailServer;
use Greenter\Mail\MailEmail;
use Greenter\Mail\Config\ConfigGmail;

class MailNotificatorTest extends \PHPUnit_Framework_TestCase{

    use StoreTrait;

    public function testNotification(){

    	$config = [
    		'SMTPDebug' => 2,
    		'isSMTP' => true,
    		'Host' => 'smtp.gmail.com',
    		'SMTPAuth' => true,
    		'Username' => 'fake@gmail.com',
    		'Password' => 'pass',
    		'SMTPSecure' => 'tls',
    		'Port' => 587
    	];

        /*$see = new See();
        $see->setService(SunatEndpoints::FE_BETA);
        $see->setCodeProvider(new XmlErrorCodeProvider());
        $see->setCertificate(file_get_contents(__DIR__ . '/../../resources/cert.pem'));
        $see->setCredentials('20000000001MODDATOS', 'moddatos');
        $see->setCachePath(__DIR__ . '/../cache');
        $res = $see->send($invoice);*/

    	$mailServer = new MailServer($config, MailServer::DEBUG);
        $mailServer->setSender(new MailEmail('fake@gmail.com', 'CORREO PRUEBA 1'));
        $mailServer->setReceipt(new MailEmail('Appee1975@dayrep.com', 'CORREO PRUEBA 2')); //fakemailgenerator.com

        $notification = new Notification();
        $notification->setDocument($this->getInvoice());
        $notification->setFiles([]);

        $logo = file_get_contents(__DIR__.'/../../resources/logo.png');
        $options = [
            'system' => [
                'logo' => $logo
            ],
            'user' => [
                'url_consulta' => 'http://',
                'telefono' => '000-0000',
                'horario_atencion' => 'Lunes a Viernes de 9:00am a 1:00pm y de 2:00pm a 6:00pm, S&aacute;bados de 9:00am a 1:00pm'
            ]
        ];
        $mailNotificator = new MailNotificator($mailServer);
        $response = $mailNotificator->notify($notification, $options);
        print_r($response);
    }
}