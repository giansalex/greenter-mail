<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 20/02/2018
 * Time: 05:52 PM
 */

namespace Greenter\Mail;

use Greenter\Notify\Notification;
use Greenter\Notify\NotificatorInterface;

use Greenter\Mail\MailServer;
use Greenter\Mail\MailSender;

class MailNotificator implements NotificatorInterface {

    private $mailServer;

    public function __construct(MailServer $mailServer){
        $this->mailServer = $mailServer;
    }

    /**
     * @param Notification $notification
     * @param array $options
     *
     * @return mixed
     */
    public function notify(Notification $notification, $options = []){
        
        $data = [
            'cliente' => 'CLIENTE SA',
            'tipo_documento' => "Factura Electrónica",
            'numero' => 'F001-1',
            'emision' => '2018-04-13',
            'vencimiento' => '2018-04-13',
            'moneda' => 'SOLES',
            'monto' => '100.00',
            'tipo' => '01',
            'uuid' => '',
            'es_gratuito' => false
        ];

        $this->mailServer->setBody($this->getTemplate($data));
        $this->mailServer->send();
    }

    private function getTemplate($data){
        $twig = new \Twig_Environment(new \Twig_Loader_Filesystem(__DIR__ . '/Templates'));
        return $twig->render('mail.html.twig', $data);
    }
}