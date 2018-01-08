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
    $this->reiceveRequestDateTime= new DateTime($reiceveRequestDateTime);
    $this->status=$status;
    $this->user=$user;
    $this->deliveryDateTime=new DateTime($deliveryDateTime);
    $this->key = $key;
  }

  public abstract function getType();

  public function getReiceveRequestDate() {
		return $this->reiceveRequestDateTime->format('d/m/o');
  }

  public function getStatus() {
		return $this->status;
  }

  public function getUser() {
		return $this->user;
  }

  public function getReiceveRequestHour() {
		return $this->reiceveRequestDateTime->format('H:i');
  }

  public function getDeliveryDate() {
		return $this->deliveryDateTime->format('d/m/o');
  }
  public function getKey(){
    return $this->key;
  }
}

?>
