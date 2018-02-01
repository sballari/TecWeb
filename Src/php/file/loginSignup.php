<!DOCTYPE HTML>
<html lang ="it">
<?php
      require_once ("CommonHtmlElement.php");
      $h = new CommonHtmlElement();
      $h->printHead("LogIn", "area personale", "login, signup");
 ?>
<body>
    <div id="accessBar">
    </div>

	<?php
	session_start();
	$h->createheader("loginSignup");
  $h->printInternalMenu("loginSignup");

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


	if(isset($_POST['login']))
		{
			if(isset($_POST['email']) && isset($_POST['password']))
			{


				$email = cleanInput($_POST['email']);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				  $ErrEm = "Validation message: Invalid email format";
				}

				$password = cleanInput($_POST['password']);
				if (!preg_match("//",$password)) {		//******** YOU HAVE TO FIXED*******
				 $ErrPassw = "Validation message: Invalid password format";
				}

				if($ErrEm == "" && $ErrPassw == ""){
				if(file_exists("../class/Authenticator.php") && file_exists("../class/DBmanager.php"))
				{
					require_once("../class/Authenticator.php");
					require_once("../class/DBmanager.php");
				}
				else
				{
					echo "Error: file does not esist.";
					exit;
				}
				$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
				$d->connect();
				$a = new Authenticator($d);

				$b = $a->validateUser($email, $password);
				if($b==false)
				{

				 $ErrLogin = "Wrong email or password! Insert your data again.";

				}
				else
				{
				$_SESSION['Email'] = $email;

				header("Location: account2.php");
				}
				}
			}
		}

		if(isset($_POST['createAccount']))
		{	if(isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['tipoUtente']) && isset($_POST['emailSignup']) && isset($_POST['passwordSignup']))
			{
				$nome = cleanInput($_POST["nome"]);
				if (!preg_match("//",$nome)) {		//******** YOU HAVE TO FIX IT*******
					$ErrNome = "Validation message: Invalid name format";
				}

				$cognome = cleanInput($_POST["cognome"]);
				if (!preg_match("//",$cognome)) {		//******** YOU HAVE TO FIX IT*******
					$ErrCognome = "Validation message: Invalid surname format";
				}

				$tipoUtente = $_POST['tipoUtente'];

				$emailSignup = cleanInput($_POST["emailSignup"]);
				if (!filter_var($emailSignup, FILTER_VALIDATE_EMAIL)) {
					$ErrEmail = "Validation message: Invalid email format";
				}

				$passwordSignup = cleanInput($_POST["passwordSignup"]);
				if (!preg_match("//",$passwordSignup)) {		//******** YOU HAVE TO FIXIT*******
					$ErrPassword = "Validation message: Invalid password format";
				}

				if($ErrNome == "" && $ErrCognome == "" && $ErrEmail == "" && $ErrPassword == ""){
				if(file_exists("../class/User.php") && file_exists("../class/Manipulator.php") && file_exists("../class/DBmanager.php"))
				{
					require_once("../class/User.php");
					require_once("../class/Manipulator.php");
					require_once("../class/DBmanager.php");
				}
				else
				{
					echo "Error: One of the files does not esist.";
					exit;
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
			}
		}


	if(!isset($_POST['signup'])){
  echo "<div id='content'>";
  echo "<div class='contentElement'>";
    echo "<p>Se non hai ancora un account non aspettare, creane uno! .</br>
    Per creare un nuovo account devi fornire i seguenti dati: <strong>nome, cognome, tipo di utente, email, password</strong></p>";
    echo "<button type='submit' name = 'signup'>Sign up, va cambiato con link</button>";
  echo "</div>";
  echo "<div class='contentElement'>";
	echo "<form action='' method='POST'>";
	echo "<fieldset>";
  	echo "<legend>Form di accesso:</legend>";
  	echo $ErrLogin."</br>";
    echo "<label for='email'>Email: </label>";
  	echo "<input type='email' name='email' placeholder='mickey.mouse@gmail.com' required><span class='err'>".$ErrEm."</span>";
    echo "</br>";
    echo "<label for='password'>Password: </label>";
  	echo "<input type='password' name='password' placeholder='insert your password' required ><span class='err'>".$ErrPassw."</span>";
    echo "</br>";
  	echo "<button type='submit' name = 'login' >Log in</button>";
	echo "</fieldset>";
	echo "</form>";
	echo "</div>";
	echo "<div id='signupButtonForm'>";
	echo "<form action='' method='POST'>";
	echo "</form>";
  echo "</div>";
  echo "</div>";
	}
	else{
    echo "<div id=content>";
		//echo "<div id='signupForm'>";
				echo "<form action=''  method='POST'>";
					echo "<fieldset>";

						echo "<legend>Creazione account</legend>";
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
            echo "</br>";
						echo "<button type='submit' name='createAccount'>Create account</button>";
					echo "</fieldset>";
				echo "</form>";
			echo "</div>";
			echo "<div id='loginButtonForm'>";
			echo "<form action='' method='POST'>";
			echo "<p>Se disponi gi&agrave di un account prego procedere all'accesso dal seguente bottone.";
			echo "<button type='submit' name = 'returnToLogin'>Log in</button>";
	echo "</form>";
	//echo "</div>";
  echo "</div>";
		}

	?>
    <?php
      $h->printContatti();
      $h->printFooter();
      $h->printMobileMenu("loginSignup");
    ?>

</body>
</html>
