<?php

    require_once("../services/DBmanager.php");
    require_once("../models/User.php");
    require_once("../services/Factory.php");

    session_start();
    $d = new DBmanager("localhost", "sballari", "Sheishioc1eith6a", "sballari");
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

      $datiInseriti=array($_POST["email"], $_POST["password"]);
      $da=serialize($datiInseriti);
      $_SESSION["datiInseriti"]=$da;

      $email = cleanInput($_POST['email']);
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["ErrEm"] = "Validazione: formato email non valido. Esempio: abc@dom.it";
      }

      $password = cleanInput($_POST['password']);
      if(!preg_match("/^(\w{4,10})*$/",$password)) {
        $_SESSION["ErrPassw"] = "Validazione: <span lang='en'>Password</span> inserita non valida. La <span lang='engl'>password</span> deve avere da 4 a 10 caratteri.";
      }

      if(!isset($_SESSION["ErrEm"]) && !isset($_SESSION["ErrPassw"])){
        require_once("../services/Authenticator.php");
        $a = new Authenticator($d);
        $b = $a->validateUser($email, $password);
        if($b==false){
          $_SESSION["ErrLogin"] = "La password o l'Email non sono corretti. Prova con  Email e password diverse.";
          header("Location: ../presentation/logIn.php");
        }
        else{
          $_SESSION['Email'] = $email;
          $u = $f->getUser($_SESSION['Email']);
          $t = $u->getUserType();
          if($t == "Impiegato"){
            header("Location: ../presentation/areaPersonaleImpiegato.php");
            unset($_SESSION["datiInseriti"]);
          }
          else{
            header("Location: ../presentation/areaPersonale.php");
            unset($_SESSION["datiInseriti"]);
          }
        }
      }
      else{
        header("Location: ../presentation/logIn.php");
      }
    }
    $d->disconnect();
  ?>
