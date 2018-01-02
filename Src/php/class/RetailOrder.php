<?php
include "Order.php"
class RetailOrder extends Order{
	private $userNote;//string
	
	function __construct($reiceveRequestDate,$status,User $user,$reiceveHour,$deliveryDate){
		parent::__construct($reiceveRequestDate,$status,$user,$reiceveHour,$deliveryDate);
		
	}
	function getUserNote(){
		return $this->userNote;
	}

	
	function getType(){
		return "al minuto";
	}

}
?>