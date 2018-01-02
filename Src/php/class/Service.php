<?php
include "Request.php"
include "Product.php"

class Service extends Request {
  private Product $serviceProd;
	private $staffNumber; //int
	private $resources; //string
	private $adress; //string
	private DateTime $eventStartHour;
		

	function __construct(Product $service, int $staffNumber, $resources, $adress, $startHour,
											$reiceveRequestDate,$status,User $user,$reiceveHour,$deliveryDate){
		 
		 parent::__construct($reiceveRequestDate,$status,$user,$reiceveHour,$deliveryDate);
		 $this->serviceProd = $service;
	   $this->staffNumber = $staffNumber; //int
	   $this->resources = $resources; //string
	   $this->adress = $adress; //string
	   $this->eventStartHour = new DateTime($startHour);
	}
	function getService(){
		return $this->serviceProd;
	}
	function getStaffNumber(){
		return $this->staffNumber;
	}
	function getType(){
		return "servizio";
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
