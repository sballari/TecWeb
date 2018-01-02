<?php
include "DBmanager.php";
include "User.php";
include "Product.php"
class Factory {
  private $dbM;

  function __construct($dbman){
    $this->dbM = $dbman;
  }

  function getUserList(){
      if ($this->dbM->getStatus()==true){
          $result = $this->dbM->submitQuery("SELECT * FROM utente");
          $arrUsr = array(); 
          while ($arr = $result->fetch_assoc()){           
              $arrUsr[] =new User ($arr['email'],
                                   $arr['password'],
                                   $arr['nome'],
                                   $arr['cognome'],
                                   $arr['tipo_utente']);  
          }
					return $arrUsr;
      }
      else return false;
  }
	
	function getProductList(){
			if ($this->dbM->getStatus()==true){
          $result = $this->dbM->submitQuery("SELECT * FROM prodotto");
          $arrUsr = array(); 
          while ($arr = $result->fetch_assoc()){           
              $arrPrd[] =new Product ($arr['imagePath'],
                                   $arr['descrizione'],
                                   $arr['ingredienti'],
                                   $arr['tipoProdotto'],
                                   $arr['nome']);  
          }
					return $arrPrd;
      }
      else return false;
	}
	
    
}
?>
