<!DOCTYPE HTML>
<html lang ="it">
<?php
      require_once ("CommonHtmlElement.php");
      $h = new CommonHtmlElement();
      $h->printHead("singUp", "area personale", "login, signup");
 ?>
<body>
    <div id="accessBar">
    </div>

	<?php
	session_start();
	$h->createheader("signUp");
  $h->printInternalMenu("signUp");

	function cleanInput($data) {
		$data = trim($data);
		$data = htmlentities($data);
		$data = strip_tags($data);
		return $data;
	}


	//Variables for login form.
	$ErrLogin = $ErrEm = $ErrPassw = "";
	$email = $password = "";

	//Variables for signup form.
	$ErrSignup = "";
	$nome = $cognome = $tipoUtente = $emailSignup = $passwordSignup = "";
	$ErrNome = $ErrCognome = $ErrTipoUtente = $ErrEmail = $ErrPassword = "";





		if(isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['tipoUtente']) && isset($_POST['emailSignup']) && isset($_POST['passwordSignup']))
			{
				$nome = cleanInput($_POST["nome"]);
				if (!preg_match("//",$nome)) {		//******** YOU HAVE TO FIX IT*******
					$ErrNome = "Errore: nome non valido";
				}

				$cognome = cleanInput($_POST["cognome"]);
				if (!preg_match("//",$cognome)) {		//******** YOU HAVE TO FIX IT*******
					$ErrCognome = "Errore: cognome non valido";
				}

				$tipoUtente = $_POST['tipoUtente'];

				$emailSignup = cleanInput($_POST["emailSignup"]);
				if (!filter_var($emailSignup, FILTER_VALIDATE_EMAIL)) {
					$ErrEmail = "Errore: email non valida";
				}

				$passwordSignup = cleanInput($_POST["passwordSignup"]);
				if (!preg_match("//",$passwordSignup)) {		//******** YOU HAVE TO FIXIT*******
					$ErrPassword = "Errore: password non valida";
				}

				if($ErrNome == "" && $ErrCognome == "" && $ErrEmail == "" && $ErrPassword == ""){
					require_once("../class/User.php");
					require_once("../class/Manipulator.php");
					require_once("../class/DBmanager.php");
				}
				$m = new Manipulator($d);
				$u = new User($emailSignup, $passwordSignup, $nome, $cognome, $tipoUtente);
				$b = $m->insertUser($u);

				if($b==FALSE)
				{
				$ErrSignup = "L'Email inserita non &egrave; disponibile. Inserire un Email diversa.";

				}
				else
				{
					$_SESSION['Email'] = $emailSignup;
					header("Location: account2.php");

				}

			}
?>

    <div id=content>
    <div class="contentElement">

			<p>
        Se disponi gi&agrave di un account prego procedere all'accesso dal seguente bottone.
			  <a href="logIn.php">Vai alla pagina di <span lang='en'>Log in</span></a>.
      </p>
   </div>
	<div class='contentElement'>
				<form action=''  method='POST'>
					<fieldset>

						<legend>Creazione account</legend>
            <?php
						echo "</br>".$ErrSignup;
						echo "<label for='nome'>Nome: </label>";
						echo "<input type='text' name='nome'  placeholder='insert your name' required><span class='err'>".$ErrNome."</span>";
            echo "</br>";
						echo "<label for='cognome'>Cognome: </label>";
						echo "<input type='text' name='cognome'  placeholder='insert your surname' required><span class='err'>".$ErrCognome."</span>";
            echo "</br>";
						echo "<label for='tipoUtente'>Tipo utente: </label>";
						echo "<select name='tipoUtente' required>
							<option value=''>--</option>
							<option value='Al minuto'>Al minuto</option>
							<option value='All ingrosso'>All'ngrosso</option>
							<option value='Servizio'>Servizio</option>
							<option value='Impiegato'>Impiegato</option>
							</select><span class='err'>".$ErrTipoUtente."</span>";

            echo "</br>";
						echo "<label for='email'>Email: </label>";
						echo "<input type='email' name='emailSignup' placeholder='mickey.mouse@gmail.com' required><span class='err'>".$ErrEmail."</span>";
            echo "</br>";
						echo "<label for='password'>Password: </label>";
						echo "<input type='password' name='passwordSignup' placeholder='insert your password' required><span class='err'>".$ErrPassword."</span>";
            ?>
            </br>
						<button type='submit' name='createAccount'>Create account</button>
					</fieldset>
				</form>
			</div>

</div>
<?php
      $h->printContatti();
      $h->printFooter();
      $h->printMobileMenu("singUp");
    ?>

</body>
</html>
