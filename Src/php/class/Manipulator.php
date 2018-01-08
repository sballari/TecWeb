<?php

class Manipulator{
  private $dbM;

  function __construct($dbM){
    $this->dbM=$dbM;
  }
  function insertUser($user){
      require_once("User.php");
      if($this->dbM->getStatus()==true){
        $query = "INSERT INTO `utente` (`email`, `nome`, `cognome`, `tipo_utente`, `password`)
                  VALUES ('".$user->getEmail()."', '".$user->getName()."', '".$user->getType()."',
                   '".$user->getType()."', '".$user->getPassword()."')";
        return $this->dbM->submitQuery($query);
      }
      else return false;
  }

  function insertProduct($product){
    require_once("Product.php");
    if($this->dbM->getStatus()==true){
      $query = "INSERT INTO prodotto (`nome`, `ingredienti`, `tipoProdotto`, `imagePath`, `descrizione`)
                VALUES ('".$product->getName()."', '".$product->getIngredients()."', '".$product->getType()."',
                 '".$product->getImage()."', '".$product->getDesc()."')";
      return $this->dbM->submitQuery($query);
    }
    else return false;
  }

  function removeUser($userEmail){
    if($this->dbM->getStatus()==true){
      $query = "DELETE FROM `utente` WHERE `utente`.`email` = '".$userEmail."';";
      return $this->dbM->submitQuery($query);
    }
    else return false;
  }

  function removeProduct($productName){
    if($this->dbM->getStatus()==true){
      $query = "DELETE FROM `prodotto` WHERE `prodotto`.`nome` = '".$productName."';";
      return $this->dbM->submitQuery($query);
    }
    else return false;
  }

  function addProductToOrder($prodKey, $orderKey, $orderType){
    if ($orderType == "All'ingrosso"){
      $table1 = "composizione_al_minuto";
      $forK = "prenotazione";
    }
    if ($orderType == "Al minuto"){
      $table1 = "composizione_all_ingrosso";
      $forK = "ordine_all_ingrosso";
    }
    if ($orderType == "Servizio") return false;
    $queryVerify = "SELECT count AS 'N', 'nr_prodotti' FROM ".$table1." WHERE
                    ".$forK." = '".$orderKey."' & prodotto='".$prodKey."';";
    $result = $this->dbM->submitQuery($queryVerify)->fetch_assoc(); // QUERY SBAGLIATA
    $number = $result["N"];
    $newNumber = $result["nr_prodotti"]+1;
    if ($number == 0) {
      $query = "INSERT INTO `".$table1."` (`".$forK."`, `prodotto`, `nr_prodotti`)
                    VALUES (".$orderKey.", '".$prodKey."', 1);";

    }
    else {
      $query = "UPDATE `".$table1."` SET 'nr_prodotti' = `".$newNumber."`
                     WHERE ".$forK." = '".$orderKey."' & prodotto='".$prodKey."';";
    }
    return $this->dbM->submitQuery($query);
  }

  function insertRequest($request){
    require_once("Request.php");
    $allOk = true;
    if($this->dbM->getStatus()==true){
      switch($request->getType()){
        case "Al minuto":
          $allOk = $this->dbM->submitQuery("START TRANSACTION;"); //inizio transazione atomica
          $query = "INSERT INTO `prenotazione` (`data_effettuazione`, `stato_ordine`, `data_ora_ritiro`, `descrizione_utente`, `utente`)
                    VALUES ('".$request->getReiceveRequestDate()."',
                     '".$request->getStatus()."',
                     '".$request->getDeliveryDate()."',
                     '".$request->getUserNote()."',
                     '".$request->getUser()->getEmail()."')";

          if ($this->dbM->submitQuery($query)){
                $products = $request->getProducts(); //ottengo i prodotti
                $allOk = $this->dbM->submitQuery("SET @profile_id = LAST_INSERT_ID();");
                foreach ($products as $prod) {
                  $queryComp = "INSERT INTO `composizione_al_minuto` (`prenotazione`, `prodotto`, `nr_prodotti`)
                                VALUES (@profile_id, '".$prod->getName()."', '".$request->getN($productKey)."',
                                 '".$request->getUserNote()."', '".$request->getUser()->getEmail()."')";
                  $allOk = $this->dbM->submitQuery($queryComp);
                }
                $allOk = $this->dbM->submitQuery("COMMIT;"); //fine transazione atomica
                return $allOk;
          }
          else {$allOk=false; return $allOk;}
        break;
        //case 2
        //case 3
    }
  }
    else return false;
  }

  function removeRequest($requestKey,$requestType){
    if($this->dbM->getStatus()==true){
      switch($requestType){
        case "Al minuto":
        $query = "DELETE FROM `prenotazione` WHERE `prenotazione`.`codice` = '".$requestKey."';";
        break;
        case "All'ingrosso":
        $query = "DELETE FROM `ordine_all_ingrosso` WHERE ``.`codice` = '".$requestKey."';";
        break;
        case "Servizi":
        $query = "DELETE FROM `richiesta_servizio` WHERE ``.`codice` = '".$requestKey."';";
        break;
      }
      return $this->dbM->submitQuery($query);
    }
    else return false;
  }
}
?>
