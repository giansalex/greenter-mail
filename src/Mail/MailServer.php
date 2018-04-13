<?php

namespace Greenter\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Greenter\Mail\MailSender;

class MailServer {

	const DEBUG = true;

	private $mail;

    public function __construct($options = [], $debug = true) {
    	$this->mail = new PHPMailer($debug);
    	$this->mail->isHTML(true);

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

    public function setSubject($subject){
    	$this->mail->Subject = $subject;
    }

    public function setReceipt(MailEmail $receipt){
    	$this->mail->addAddress($receipt->getEmail(), $receipt->getName());
    }

    public function setBody($data){
    	$this->mail->Body = $data;
    }

    public function send(){
    	$response = array('success' => true, 'error' => false, 'message' => '');
    	try {
    		$this->mail->send();
    		$response['message'] = 'Correo enviado';
    	} catch (Exception $e) {
		    $response['error'] = true;
		    $response['message'] = $this->mail->ErrorInfo;
		}

		return $response;
    }
}