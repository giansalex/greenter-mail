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
        return $this->mailServer->send($notification, $options);
    }

}