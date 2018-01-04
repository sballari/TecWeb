<?php
include "DBmanager.php";
include "User.php";
include "Product.php";
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

 private function getUser($key){
   if ($this->dbM->getStatus()==true){
     $result = $this->dbM->submitQuery("SELECT * FROM utente WHERE email='".$key."'");
     $us = $result->fetch_assoc();
     if ($us == NULL) return false;
     return new User     ($us['email'],
                          $us['password'],
                          $us['nome'],
                          $us['cognome'],
                          $us['tipo_utente']);
   }
   else return false;
 }

	function getProductList($typeP){
    //typeP can be "Al minuto", "Allingrosso", "Servizi"
      if ($typeP != "Al minuto" && $typeP != "All'ingrosso" && $typeP!="Servizi") return false;
			if ($this->dbM->getStatus()==true){
          $result = $this->dbM->submitQuery("SELECT * FROM prodotto WHERE tipoProdotto='".$typeP."'");
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
  private function getProduct($key){
    if ($this->dbM->getStatus()==true){
      $result = $this->dbM->submitQuery("SELECT * FROM Prodotto WHERE nome='".$key."'");
      $product = $result->fetch_assoc();
      return new Product ( $product['imagePath'],
                           $product['descrizione'],
                           $product['ingredienti'],
                           $product['tipoProdotto'],
                           $product['nome']);
    }
  }
  private function getOrderProductList($OrderKey, $tipoOrdine){
    if ($tipoOrdine != "All'ingrosso" && $tipoOrdine != "Al minuto") return false;
    if ($tipoOrdine == "All'ingrosso") {
      $table = "composizione_all_ingrosso";
      $secKey="ordine_all_ingrosso";
    }
    if ($tipoOrdine == "Al minuto") {
      $table = "composizione_al_minuto";
       $secKey="prenotazione";
     }
    if ($this->dbM->getStatus()==true){
      $result = $this->dbM->submitQuery("SELECT * FROM ".$table."
                                         JOIN prodotto ON nome = ".$table.".prodotto
                                         WHERE ".$secKey."='".$OrderKey."'");
     $arrProd=array();
     while ($p = $result->fetch_assoc()){
       $arrProd[]=new Product(
         $p['imagePath'],
         $p['descrizione'],
         $p['ingredienti'],
         $p['tipoProdotto'],
         $p['nome']
       );
     }
     return $arrProd;
    }
    else return false;
  }

	function getRequestList($userEmail){

		if ($this->dbM->getStatus()==true){
        $user = $this->getUser($userEmail);
        if ($user==false) {echo "Error: email doesn't exist"; return false;}
				$tipoUtente = $user->getType();
				$email = "'".$userEmail."'";

         switch($tipoUtente){
					 case "Servizi":
             require_once("Service.php");
						 $result = $this->dbM->submitQuery("SELECT * FROM richiesta_servizio WHERE utente = ".$email);
             $arrRet = array();
             while ($s= $result->fetch_assoc()){
               $arrRet[]=new Service( $this->getProduct($s['Prodotto_servizio']),
                            $s['personale_richiesto'],
                            $s['risorse_necessarie'],
                            $s['indirizzo_evento'],
                            $s['data_effettuazione'],   //da vedere Bene
                            $s['stato_ordine'],
                            $user,
                            $s['data_ora_evento'],
                            $s['codice']);
            }
            return $arrRet;
					 break;
					 case "All'ingrosso":
             require_once("MassiveOrder.php");
						 $result = $this->dbM->submitQuery("SELECT * FROM ordine_all_ingrosso WHERE utente = ".$email);
             $arrRet = array();
             while ($s = $result->fetch_assoc()){
              $element = new MassiveOrder(
                 $s['indirizzo_consegna'],
                 $s['periodicita'],
                 $s['data_effettuazione'],
                 $s['stato_ordine'],
                 $user,
                 $s['data_ora_consegna'],
                 $s['codice']
               );
               $arrP = $this->getOrderProductList($element->getKey(), "All'ingrosso");
               $element->insertProducts($arrP);
               $arrRet[]=$element;
             }
             return $arrRet;
					 break;
					 case "Al minuto":
             require_once("RetailOrder.php");
						 $result = $this->dbM->submitQuery("SELECT * FROM prenotazione WHERE utente = ".$email);
             $arrRet = array();
             while ($s = $result->fetch_assoc()){
             $element = new RetailOrder(
                $s['data_effettuazione'],
                $s['stato_ordine'],
                $user,
                $s['descrizione_utente'],
                $s['data_ora_ritiro'],
                $s['codice']
              );
              $arrP = $this->getOrderProductList($element->getKey(),"Al minuto");
              $element->insertProducts($arrP);
              $arrRet[]=$element;
            }
            return $arrRet;
					 break;
				 }

       }
      else return false;
}
}
?>
