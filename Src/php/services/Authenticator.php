<?php
require_once("../models/User.php");
require_once("Factory.php");
require_once("DBmanager.php");

class Authenticator{
  private $dbM;
  function __construct($dbM) {
    $this->dbM = $dbM;
  }

  public function validateUser($email, $password){
    $query = "SELECT count(email) AS n FROM utente WHERE email='".$email."' AND password='".$password."';";
    $result = $this->dbM->submitQuery( $query );
    $res_array = $result->fetch_assoc();
    if ($res_array["n"] == 1) {
      $fact = new Factory($this->dbM);
      return $fact->getUser($email);
    }
    else return false;
  }

}

?>
