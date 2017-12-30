<?php
//parent::calcolaStip() + $bonus;
//parent::__construct($surname);
//$obj2 = clone $obj1;
// public function __clone(){
//     // associazione
//     $this->azienda = "Warner Bros.";
//     }
//
// }
//function __destruct() {
//        $conn->disconect();
//        echo "Distruttore ";
//    }
//__isset e __unset
// the return string can be :
// 'Al minuto',
// 'All'ingrosso',
// 'Servizio'
// date("Y/m/d")
//date("01-12:00-59:sa") es: 06:05:00pm

abstract class Request {
  private int $reiceveRequestDate; //DateTime
  private $status;
  private $user;
  private int $receveRequestHour; //DateTime
  private int $deliveryDate; //DateTime

  function __construct($reiceveRequestDate,$status,$user,$receveHour,$deliveryDate) {
    global   $requestDate, $status, $user, $receveHour, $deliveryDate;
    $requestDate= $requestDate;
    $status=$status;
    $user=$user;
    $receveHour=$receveHour;
    $deliveryDate=$deliveryDate;
  }

  public abstract function getType() {
    //the type can be "al minuto", "all'ingrosso", "al dettaglio";
  }

  public function getReiceveRequestDate() {

  }

  public function getStatus() {

  }

  public function getUser() {

  }

  public function getReiceveRequestHour() {

  }

  public function getDeliveryDate() {

  }

}

?>
