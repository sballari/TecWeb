<?php

class CommonHtmlElement{




	function __construct()
	{
	}

	public function cleanInput($data) {
		$data = trim($data);
		$data = htmlentities($data);
		$data = strip_tags($data);
		return $data;
	}


	public function createheader($page){
		echo "<div id='header'>";
			echo "<img  id='logo' src='../../img/logo.jpg' alt='logo i tesori di Squitty'>";
			echo "<h1>I tesori di <span lang='en'>Squitty</span></h1>";
			echo "<div id='menu' >";
				switch($page){
					case "home":
						echo "<ul>";
							echo "<li><span>Home</span></li>";
							echo "<li><a href='casa.php'>Per la tua casa</a></li>";
							echo "<li><a href='ristorante.php'>Per il tuo ristorante</a></li>";
							echo "<li><a href='catering.php'>Catering ed Eventi</a></li>";
							echo "<li>";
								echo "<form action='/search_page.php'>";
									echo "<input id='search' type='search' name='search' placeholder='Cerca...'>";
									echo "<input type='submit' value='Cerca'>";
								echo "</form>";
							echo "</li>";

						echo "</ul>";
						break;
					case "casa":
						echo "<ul>";
							echo "<li><a href='home.php'>Home</a></li>";
							echo "<li><span>Per la tua casa</span></li>";
							echo "<li><a href='ristorante.php'>Per il tuo ristorante</a></li>";
							echo "<li><a href='catering.php'>Catering ed Eventi</a></li>";
							echo "<li>";
								echo "<form action='/search_page.php'>";
									echo "<input id='search' type='search' name='search' placeholder='Cerca...'>";
									echo "<input type='submit' value='Cerca'>";
								echo "</form>";
							echo "</li>";
						echo "</ul>";
						break;
					case "ristorante":
						echo "<ul>";
							echo "<li><a href='home.php'>Home</a></li>";
							echo "<li><a href='casa.php'>Per la tua casa</a></li>";
							echo "<li><span>Per il tuo ristorante</span></li>";
							echo "<li><a href='catering.php'>Catering ed Eventi</a></li>";
							echo "<li>";
								echo "<form action='/search_page.php'>";
									echo "<input id='search' type='search' name='search' placeholder='Cerca...'>";
									echo "<input type='submit' value='Cerca'>";
								echo "</form>";
							echo "</li>";
						echo "</ul>";
						break;
					case "catering":
						echo "<ul>";
							echo "<li><a href='home.php'>Home</a></li>";
							echo "<li><a href='casa.php'>Per la tua casa</a></li>";
							echo "<li><a href='ristorante.php'>Per il tuo ristorante</a></li>";
							echo "<li><span>Catering ed Eventi</span></li>";
							echo "<li>";
								echo "<form action='/search_page.php'>";
									echo "<input id='search' type='search' name='search' placeholder='Cerca...'>";
									echo "<input type='submit' value='Cerca'>";
								echo "</form>";
							echo "</li>";
						echo "</ul>";
						break;
				}
			echo "</div>";
		echo "</div>";
	}



	public function generatelogin(){


		$ErrLogin = "";

		$ErrEm = "";
		$ErrPassw = "";



		$email = $password = "";



		session_start();
		if((!isset($_POST['email'])) || (!isset($_POST['password'])))
		{
		// OnSubmit display message!
			echo "<div>";
				echo "<form action='' method='POST'>";
					echo "<fieldset>";
						echo "<legend>Log In:</legend>";
						echo "<br>".$ErrLogin;
						echo "<br>";
						echo "Email:<br>";
						echo "<input type='email' name='email' placeholder='mickey.mouse@gmail.com' required>".$ErrEm;
						echo "<br>";
						echo "Password:<br>";
						echo "<input type='password' name='password' placeholder='insert your password' required >".$ErrPassw;
						echo "<br><br>";
						echo "<input type='submit' name = 'submit' value='Login'>";
					echo "</fieldset>";
				echo "</form>";
			echo "</div>";





		}
		else
		{
			// Validazio del pattern: se l'utente ha scritto l'email nella forma giusta.




			 $email = $this->cleanInput($_POST["email"]);
			 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				  $ErrEm = "Validation message: Invalid email format";
			 }

			  $password = $this->cleanInput($_POST["password"]);
			 if (!preg_match("//",$password)) {		//******** YOU HAVE TO FIXED*******
				 $ErrPassw = "Validation message: Invalid password format";
			 }



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
				//********FIX THE MESSAGE DISPLAY****************
				 $ErrLogin = "Wrong email or password! Insert your data again. Please remember that password must contain at least 8 caracters and at most 12 caracters.";
				header("Location: casa.php");
			}
			else
			{

				header("Location: account2.php");

			}

		}



	}




	public function generateSignup(){



		  $ErrSignup = "";


		$nome = $cognome = $tipoUtente = $email = $password = "";
		$ErrNome = $ErrCognome = $ErrTipoUtente = $ErrEmail = $ErrPassword = "";


		if((!isset($_POST['nome'])) || (!isset($_POST['cognome'])) || (!isset($_POST['tipoUtente'])) || (!isset($_POST['email'])) || (!isset($_POST['password'])))
		{
		// OnSubmit display message!
			echo "<div>";
				echo "<form action=''  method='POST'>";
					echo "<fieldset>";

						echo "<legend>Sign Up</legend>";
						echo "<br>".$ErrSignup;
						echo "Nome:<br>";
						echo "<input type='text' name='nome'  placeholder='insert your name' required>".$ErrNome;
						echo "<br>";
						echo "Cognome:<br>";
						echo "<input type='text' name='cognome'  placeholder='insert your surname' required>".$ErrCognome;
						echo "<br>";
						echo "Tipo utente:<br>";
						echo "<select name='tipoUtente' required>
							<option value=''>--</option>
							<option value='Al minuto'>Al minuto</option>
							<option value='All ingrosso'>All'ngrosso</option>
							<option value='Servizio'>Servizio</option>
							<option value='Impiegato'>Impiegato</option>
							</select>".$ErrTipoUtente;
						echo "<br>";
						echo "Email:<br>";
						echo "<input type='email' name='email' placeholder='mickey.mouse@gmail.com' required>".$ErrEmail;
						echo "<br>";
						echo "Password:<br>";
						echo "<input type='password' name='password' placeholder='insert your password' required>".$ErrPassword;
						echo "<br><br>";
						echo "<input type='submit' value='Create account'>";
					echo "</fieldset>";
				echo "</form>";
			echo "</div>";



		}
		else{




			$nome = $this->cleanInput($_POST["nome"]);
			 if (!preg_match("//",$nome)) {		//******** YOU HAVE TO FIX IT*******
				$ErrNome = "Validation message: Invalid name format";
			 }

			 $cognome = $this->cleanInput($_POST["cognome"]);
			 if (!preg_match("//",$cognome)) {		//******** YOU HAVE TO FIX IT*******
				$ErrCognome = "Validation message: Invalid surname format";
			 }
			$email = $this->cleanInput($_POST["email"]);
			 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				 $ErrEmail = "Validation message: Invalid email format";
			 }

			 $password = $this->cleanInput($_POST["password"]);
			 if (!preg_match("//",$password)) {		//******** YOU HAVE TO FIXIT*******
				$ErrPassword = "Validation message: Invalid password format";
			 }

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
			$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
			$d->connect();
			$m = new Manipulator($d);
			$u = new User( $email, $password, $nome, $cognome, $tipoUtente);
			$b = $m->insertUser($u);

			if($b==FALSE)
			{
				$ErrSignup = "Email has already been used. Insert your data again. Please remember that password must contain at least 8 caracters and at most 12 caracters.";
				header("Location: casa.php");
			}
			else
			{
				header("Location: account2.php");

			}
		}

	}








}
	?>
