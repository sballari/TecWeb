<?php


abstract class Request {
  private $reiceveRequestDateTime; //DateTime
  private $status; //string
  private $user; //User
  private $deliveryDateTime; //DateTime
  private $key; // NULL means that the object isn't create from DB input, but from user input
/*
 *PRE: I formati di data e ora devono essere stringhe codificate con la sequente specifica
 *http://php.net/manual/en/datetime.formats.time.php
*/
  function __construct($reiceveRequestDateTime,$status,User $user,$deliveryDateTime, $key) {
    try{$this->reiceveRequestDateTime = new DateTime($reiceveRequestDateTime);}
    catch(Exception $e) {echo $e->getMessage(); exit(1);}
    $this->status=$status;
    $this->user=$user;
    $this->deliveryDateTime=new DateTime($deliveryDateTime);
    $this->key = $key;
  }

  public abstract function getType();

  public function getReiceveRequestDate() {
		return $this->reiceveRequestDateTime->format('d/m/o');
  }

  public function getReiceveRequestHour() {
    return $this->reiceveRequestDateTime->format('H:i');
  }
  
  public function getReiceveRequestDateTime(){
    return $this->reiceveRequestDateTime->format('Y-m-d H:i:s');
  }

  public function getDeliveryDateTime(){
    return $this->deliveryDateTime->format('Y-m-d H:i:s');
  }

  public function getStatus() {
		return $this->status;
  }

  public function getUser() {
		return $this->user;
  }

  public function getDeliveryDate() {
		return $this->deliveryDateTime->format('d/m/o');
  }
  public function getKey(){
    return $this->key;
  }

}

?>
