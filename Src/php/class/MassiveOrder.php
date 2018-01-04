<?php
include "Order.php";
class MassiveOrder extends Order{
	private $deliveryAdress; //string
	private $periodicity; //string "settimanale","mensile" periodicita' di deliveryDate
	function __construct($devAdr, $periodicity,$reiceveRequestDateTime,$status,User $user,$deliveryDateTime,$key){
		parent::__construct($reiceveRequestDateTime,$status,$user,$deliveryDateTime,$key);
		$this->deliveryAdress = $devAdr;
		$this->periodicity = $periodicity;
	}
	function getPeriodicity(){
		return $this->periodicity;
	}
	function getDeliveryAdress(){
		return $this->deliveryAdress;
	}

	function getType(){
		return "All'ingrosso";
	}

}
?>
