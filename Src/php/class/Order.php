<?php
include "Request.php"

abstract class Order extends Request {
	private $products = array();

  function __construct($reiceveRequestDate,$status,User $user,$reiceveHour,$deliveryDate) {
	  parent::__construct($reiceveRequestDate,$status,$user,$reiceveHour,$deliveryDate);
  }
	function getProducts(){
		return $products;
	}
	function insertProduct(Product $prod){
		products[] = $prod; 
	}
	


}

?>
