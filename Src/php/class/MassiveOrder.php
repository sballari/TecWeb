<?php
include "Order.php"
class MassiveOrder extends Order{
	private $deliveryAdress; //string
	private $periodicity; //string "settimanale","mensile" periodicita' di deliveryDate
	function __construct($devAdr, $periodicity,$reiceveRequestDate,$status,User $user,$reiceveHour,$deliveryDate){
		parent::__construct($reiceveRequestDate,$status,$user,$reiceveHour,$deliveryDate);
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
		return "all'ingrosso";
	}

}
?>