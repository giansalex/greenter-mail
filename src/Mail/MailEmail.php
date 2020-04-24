<?php

namespace Greenter\Mail;

class MailEmail {

	private $email;
	private $name;

    public function __construct($email, $name) {
    	$this->email = $email;
    	$this->name = $name;
    }

    public function setEmail($email){
    	$this->email = $email;
    }

    public function getEmail(){
    	return $this->email;
    }

    public function setName($name){
    	$this->name = $name;
    }

    public function getName(){
    	return $this->name;
    }
}