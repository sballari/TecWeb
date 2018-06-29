<?php
    require_once("../services/Factory.php");
    require_once("../models/User.php");
    require_once("../services/Manipulator.php");
    require_once("../services/DBmanager.php");
    $d = new DBmanager("localhost", "root", "", "sballari");
    $d->connect();
    $f = new Factory($d);

    session_start();
    function cleanInput($data) {
      $data = trim($data);
      $data = htmlentities($data);
      $data = strip_tags($data);
      return $data;
    }

   $nome = $cognome = $tipoUtente = $emailSignup = $passwordSignup = "";

   if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["tipoUtente"]) && isset($_POST["emailSignup"]) && isset($_POST["passwordSignup"])){

     $datiInseriti=array($_POST["nome"], $_POST["cognome"], $_POST["tipoUtente"], $_POST["emailSignup"], $_POST["passwordSignup"]);
     $data=serialize($datiInseriti);
     $_SESSION["datiIn"]=$data;

     $nome = cleanInput($_POST["nome"]);
     if(!preg_match("/^[a-zA-Z]*$/",$nome)) {
       $_SESSION["ErrNome"] = "Errore: nome non valido. Il nome deve contenere solo caratteri.";
     }

     $cognome = cleanInput($_POST["cognome"]);
     if(!preg_match("/^[a-zA-Z]*$/",$cognome)) {
       $_SESSION["ErrCognome"] = "Errore: cognome non valido. Il cognome deve contenere solo caratteri.";
     }

     $tipoUtente = $_POST['tipoUtente'];

     $emailSignup = cleanInput($_POST["emailSignup"]);
     if(!filter_var($emailSignup, FILTER_VALIDATE_EMAIL)) {
       $_SESSION["ErrEmail"] = "Errore: email non valida";
     }

      $passwordSignup = cleanInput($_POST["passwordSignup"]);
      if (!preg_match("/^(\w{4,10})*$/",$passwordSignup)) {
        $_SESSION["ErrPassword"] = "Errore: password non valida. La password deve avere da 4 alle 10 caratteri alfanumerici.";
      }

      if(!isset($_SESSION["ErrNome"]) && !isset($_SESSION["ErrCognome"]) && !isset($_SESSION["ErrEmail"]) && !isset($_SESSION["ErrPassword"])){

        $m = new Manipulator($d);
        $u = new User($emailSignup, $passwordSignup, $nome, $cognome, $tipoUtente);
        $b = $m->insertUser($u);

        if($b==FALSE){
          $ErrSignup = "L'Email inserita non &egrave; disponibile. Inserire un Email diversa.";
          header("Location: ../presentation/signUp.php");
        }
        else{
          $_SESSION['Email'] = $emailSignup;
          $u = $f->getUser($_SESSION['Email']);
          $t = $u->getUserType();
          if($t == "Impiegato"){
            header("Location: ../presentation/areaPersonaleImpiegato.php");
            unset($_SESSION["datiIn"]);
          }
          else{
            header("Location: ../presentation/areaPersonale.php");
            unset($_SESSION["datiIn"]);
          }
        }
      }
      else{
        header("Location: ../presentation/signUp.php");
      }
    }
 ?>
