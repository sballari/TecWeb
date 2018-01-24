<?php
require_once("Request.php");

abstract class Order extends Request {
	private $products = array();

  function __construct($reiceveRequestDateTime,$status,User $user,$deliveryDateTime,$key) {
	  parent::__construct($reiceveRequestDateTime,$status,$user,$deliveryDateTime,$key);
  }
	function getProducts(){
		return $this->products;
	}
	function insertProduct(Product $prod){
		$this->products[] = $prod;
	}
	function insertProducts($arrayP){
		array_merge($this->products, $arrayP);
	}


}

?>
