<!DOCTYPE HTML>
<html lang ="it">
  <?php
      require_once("CommonHtmlElement.php");
      require_once("../services/DBmanager.php");
      require_once("../models/User.php");
      require_once("../services/Factory.php");
      $h = new CommonHtmlElement();
      $h->printHead("LogIn", "area personale", "login, signup");
  ?>
  <body onload='creaStatistiche()'>
    <?php
	    session_start();
      $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
      $d->connect();
      $f = new Factory($d);
      if(isset($_SESSION['Email'])){
        $u = $f->getUser($_SESSION['Email']);
        $t = $u->getUserType();
        if($t == "Impiegato"){
          header("Location: areaPersonaleImpiegato.php");
        }
        else{
          header("Location: areaPersonale.php");
        }
      }
	    $h->createheader("logIn");
      $h->printInternalMenu("logIn");

	    function cleanInput($data) {
		    $data = trim($data);
		    $data = htmlentities($data);
		    $data = strip_tags($data);
	      return $data;
	    }

	    //Variables for login form.
	    $ErrLogin = $ErrEm = $ErrPassw = "";
	    $email = $password = "";

	    if(isset($_POST['email']) && isset($_POST['password'])){

        $email = cleanInput($_POST['email']);
		    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		      $ErrEm = "Validation message: Invalid email format";
		    }

		    $password = cleanInput($_POST['password']);
		    if(!preg_match("//",$password)) {		//******** YOU HAVE TO FIXED*******
          $ErrPassw = "Validation message: Invalid password format";
		    }

		    if($ErrEm == "" && $ErrPassw == ""){
		      require_once("../services/Authenticator.php");
			    $a = new Authenticator($d);
          $b = $a->validateUser($email, $password);
			    if($b==false){
            $ErrLogin = "La password o l'Email non sono corretti. Prova con  Email e password diverse.";
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
	    }
      $d->disconnect();
    ?>
    <div id='content'>
      <div id='info' class='contentElement'>
      	<h3>INFO</h3>
        <p>Se non hai ancora un account non aspettare, creane uno! Per creare un nuovo account devi fornire i seguenti dati:
          <strong>nome, cognome, tipo di utente, email, password</strong>.
        </br>
          <a href="signUp.php">Vai alla pagina di  <span lang='en'>Sign up</span></a>.
        </p>
      </div>
      <div id='form' class='contentElement'>
      	<form action='' method='POST'>
      	<fieldset>
        	<legend>Form di accesso:</legend>
          <?php
        	  echo $ErrLogin."</br>";
            echo "<div id=email>";
            echo "<label for='email'>Email: </label>";
        	  echo "<input type='email' name='email' placeholder='mickey.mouse@gmail.com' required><span class='err'>".$ErrEm."</span>";
            echo "</div>";
            echo "<div id=password>";
            echo "<label for='password'>Password: </label>";
        	  echo "<input type='password' name='password' placeholder='insert your password' required ><span class='err'>".$ErrPassw."</span>";
            echo "</div>";
          ?>
          </br>
        	<button type='submit' name = 'login' >Log in</button>
      	</fieldset>
      	</form>
    	</div>
    </div>

		<?php
		  $h->createStatisticDiv();
      $h->printContatti();
      $h->printFooter();
      $h->printMobileMenu("logIn");
    ?>

  </body>
</html>
