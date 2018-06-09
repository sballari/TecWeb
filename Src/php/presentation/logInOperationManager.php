<?php

    require_once("../services/DBmanager.php");
    require_once("../models/User.php");
    require_once("../services/Factory.php");

    session_start();
    $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
    $d->connect();
    $f = new Factory($d);

    function cleanInput($data) {
      $data = trim($data);
      $data = htmlentities($data);
      $data = strip_tags($data);
      return $data;
    }

    $email = $password = "";

    if(isset($_POST['email']) && isset($_POST['password'])){

      $email = cleanInput($_POST['email']);
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["ErrEm"] = "Validation message: Invalid email format";
      }

      $password = cleanInput($_POST['password']);
      if(!preg_match("/^(\w{4,10})*$/",$password)) {
        $_SESSION["ErrPassw"] = "Validation message: Invalid password format. Password must have from 4 to 10 alfanumeric characters.";
      }

      if(!isset($_SESSION["ErrEm"]) && !isset($_SESSION["ErrPassw"])){
        require_once("../services/Authenticator.php");
        $a = new Authenticator($d);
        $b = $a->validateUser($email, $password);
        if($b==false){
          $_SESSION["ErrLogin"] = "La password o l'Email non sono corretti. Prova con  Email e password diverse.";
          header("Location: logIn.php");
        }
        else{
          $_SESSION['Email'] = $email;
          $u = $f->getUser($_SESSION['Email']);
          $t = $u->getUserType();
          if($t == "Impiegato"){
            header("Location: areaPersonaleImpiegato.php");
          }
          else{
            header("Location: areaPersonale.php");
          }
        }
      }
      else{
        header("Location: logIn.php");
      }
    }
    $d->disconnect();
  ?>
