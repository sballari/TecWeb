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
	
	function getRequest(User $user){
		if ($this->dbM->getStatus()==true){
				$tipoUtente = $user->getType();
				$email = $user->getEmail();
			
         switch($tipoUtente){
					 case "Servizi":
						 $result = $this->dbM->submitQuery("SELECT * FROM richiesta_servizio WHERE utente = ".$email);
						 
					 break;
					 case "All'ingrosso":
						 $result = $this->dbM->submitQuery("SELECT * FROM ordine_all'ingrosso WHERE utente = ".$email);
					 break;
					 case "Al minuto":
						 $result = $this->dbM->submitQuery("SELECT * FROM prenotazione WHERE utente = ".$email);
					 break;					 
				 }
			
       }
      else return false;    
}
?>
