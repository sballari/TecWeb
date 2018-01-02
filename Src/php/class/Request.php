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
  private $reiceveRequestDate; //DateTime
  private $status; //string
  private $user; //User
  private $receveRequestHour; //DateTime
  private $deliveryDate; //DateTime
/*
 *PRE: I formati di data e ora devono essere stringhe codificate con la sequente specifica
 *http://php.net/manual/en/datetime.formats.time.php
*/
  function __construct($reiceveRequestDate,$status,User $user,$reiceveHour,$deliveryDate) {
    $this->requestDate= new DateTime($requestDate);
    $this->status=$status;
    $this->user=$user;
    $this->receveHour= new DateTime($receveHour);
    $this->deliveryDate=new DateTime($deliveryDate);
		$this->type = $tp;
  }

  public abstract function getType();

  public function getReiceveRequestDate() {
		$this->ReiceveRequestDate->format('d/m/o');
  }

  public function getStatus() {
		return $this->status;
  }

  public function getUser() {
		return $this->user;
  }

  public function getReiceveRequestHour() {
		$this->ReiceveRequestHour->format('H:i');
  }

  public function getDeliveryDate() {
		$this->deliveryDate->format('d/m/o');
  }

}

?>
