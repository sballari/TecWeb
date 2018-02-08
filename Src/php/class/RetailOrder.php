<?php
require_once("Order.php");
class RetailOrder extends Order{
	private $userNote;//string

	function __construct($reiceveRequestDateTime,$status,User $user,$userNote,$deliveryDate,$key){
		parent::__construct($reiceveRequestDateTime ,$status,$user,$deliveryDate,$key);
		$this->userNote=$userNote;

	}
	function getUserNote(){
		return $this->userNote;
	}


	function getType(){
		return "Al minuto";
	}

}
?>
