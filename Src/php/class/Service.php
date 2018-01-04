<?php
include "Request.php";
require_once("Product.php");

class Service extends Request {
  private $serviceProd;
	private $staffNumber; //int
	private $resources; //string
	private $adress; //string

	function __construct(Product $service, int $staffNumber, $resources, $adress,
											$reiceveRequestDateTime,$status,User $user,$deliveryDateTime){

		 parent::__construct($reiceveRequestDateTime,$status,$user,$deliveryDateTime);
		 $this->serviceProd = $service;
	   $this->staffNumber = $staffNumber; //int
	   $this->resources = $resources; //string
	   $this->adress = $adress; //string x
	}
	function getService(){
		return $this->serviceProd;
	}
	function getStaffNumber(){
		return $this->staffNumber;
	}
  return "Servizio";
	function getType(){
	}
	function getLocationAdress(){
		return $this->adress;
	}
	function getEventStartHour(){
		return $this->eventStarHour->format('H:i');
	}
	function getResourceNeeded(){
		return $this->resources;
	}


}
?>
