<?php

namespace Greenter\Mail;

use Greenter\Notify\Notification;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Greenter\Mail\MailSender;

use Greenter\Report\HtmlReport;
use Greenter\Model\DocumentInterface;

class MailServer {

	const DEBUG = true;
	const SUBJECT = 'Documento electrónico emitido por {}';

	protected $mail;

    public function __construct($options = [], $debug = true) {
    	$this->mail = new PHPMailer($debug);
    	$this->mail->isHTML(true);
        $this->mail->CharSet = 'UTF-8';

    	if(isset($options['SMTPDebug'])){
	    	$this->mail->SMTPDebug = $options['SMTPDebug'];
	    }

	    if(isset($options['isSMTP'])){
	    	if(is_bool($options['isSMTP']) && $options['isSMTP']){
		    	$this->mail->isSMTP();
		    }
	    }

	    if(isset($options['Host'])){
	    	$this->mail->Host = $options['Host'];
	    }

	    if(isset($options['SMTPAuth'])){
	    	if(is_bool($options['SMTPAuth'])){
		    	$this->mail->SMTPAuth = $options['SMTPAuth'];
		    }
	    }

	    if(isset($options['Username']) && isset($options['Password'])){
	    	$this->mail->Username = $options['Username'];
	    	$this->mail->Password = $options['Password'];
	    }

	    if(isset($options['SMTPSecure'])){
	    	$this->mail->SMTPSecure = $options['SMTPSecure'];
	    }

	    if(isset($options['Port'])){
	    	$this->mail->Port = $options['Port'];
	    }

    }

    public function setSender(MailEmail $sender){
    	$this->mail->setFrom($sender->getEmail(), $sender->getName());
    }

    public function setReceipt(MailEmail $receipt){
    	$this->mail->addAddress($receipt->getEmail(), $receipt->getName());
    }

    private function setBody(DocumentInterface $document, $options = []){
        $content = $this->getTemplate($document, $options);
        $this->mail->Body = $content;
        $this->mail->Subject = str_replace('{}', $document->getCompany()->getRazonSocial(), MailServer::SUBJECT);
    }

    private function setAttachment($files){
        foreach ($files as $file) {
    	   $this->mail->AddStringAttachment($file->getContent(), $file->getName(), 'base64', $file->getType());
        }
    }

    public function send(Notification $notification, $options = []){
    	$response = array('success' => true, 'error' => false, 'code' => 0, 'message' => '');
    	
        $this->setBody($notification->getDocument(), $options);
        $this->setAttachment($notification->getFiles());

		if (!$this->mail->send()) {
            $response['message'] = 'Correo enviado';
        } else {
            $response['error'] = true;
            $response['message'] = $this->mail->ErrorInfo;
        }

		return $response;
    }

    private function getTemplate(DocumentInterface $document, $options = []){
        $html = new HtmlReport(__DIR__ . '/Templates', [
            //'cache' => __DIR__ . '/../cache',
            'strict_variables' => true
        ]);
        $html->setTemplate('mail.html.twig');
        return $html->render($document, $options);
    }
}