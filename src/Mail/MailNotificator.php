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

class MailNotificator implements NotificatorInterface
{
    /**
     * @param Notification $notification
     * @param array $options
     *
     * @return mixed
     */
    public function notify(Notification $notification, $options = [])
    {
        // TODO: Implement notify() method.
    }
}