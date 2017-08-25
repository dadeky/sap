<?php
namespace Sap\Domain;

class ErrorMessage 
{
	private $type;
	private $number;
	private $id;
	private $parameter1;
	private $parameter2;
	private $parameter3;
	private $parameter4;
	private $messageText;
	
	public function __construct(
			 $type,
			 $number,
			 $id,
			 $parameter1,
			 $parameter2,
			 $parameter3,
			 $parameter4,
			 $messageText
	){
		$this->type = $type;
		$this->number = $number;
		$this->id = $id;
		$this->parameter1 = $parameter1;
		$this->parameter2 = $parameter2;
		$this->parameter3 = $parameter3;
		$this->parameter4 = $parameter4;
		$this->messageText = $messageText;
	}
	
	public function getType() {
		return $this->type;
	}
	public function getNumber() {
		return $this->number;
	}
	public function getId() {
		return $this->id;
	}
	public function getParameter1() {
		return $this->parameter1;
	}
	public function getParameter2() {
		return $this->parameter2;
	}
	public function getParameter3() {
		return $this->parameter3;
	}
	public function getParameter4() {
		return $this->parameter4;
	}
	public function getMessageText() {
		return $this->messageText;
	}
	
}