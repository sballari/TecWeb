<?php

class CommonHtmlElement{




	function __construct()
	{
	}

<<<<<<< HEAD
=======
	public function cleanInput($data) {
		$data = trim($data);
		$data = htmlentities($data);
		$data = strip_tags($data);
		return $data;
	}

	public function printHead($title, $description, $keyword){
		echo "<head>";
		echo "\n";
		echo '<title> "'.$title.'" - I tesori di Squitty </title>';
		echo "\n";
		echo '<meta name="title" content="'.$title.'" />';
		echo "\n";
		echo '<meta name="author" content="Simone Ballarin, Gerta Llieshi, Alessio Gobbo, Dario Riccardo"/>';
		echo "\n";
		echo '<meta name="description" content="'.$description.'" />';
		echo "\n";
		echo '<meta name="keywords" content="Squitty, pasticceria, dolci, '.$keyword.'"/>';
		echo "\n";
		echo '<meta name="language" content="italian it"/>';
		echo "\n";
		echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';
		echo "\n";
		echo '<link rel="stylesheet" media="screen" href="../../css/stile.css" type="text/css"/>';
		echo "\n";
		echo '<link rel="stylesheet" media="print" href="../../css/print.css" type="text/css" />';
		echo "\n";
		echo '<link rel="stylesheet" media="screen and (max-width:925px)" href="../../css/mobile.css" type="text/css" />';
		echo "\n";
		echo '</head>';
		echo "\n";
	}
	public function createheader($page){
		echo "<div id='header'>";
			echo "<img  id='logo' src='../../img/logo.png' alt='logo i tesori di Squitty'>";
			echo "<h1>I tesori di <span lang='it'>Squitty</span></h1>";
			echo "<div id='menu' >";
			echo "<ul>";
				switch($page){
					case "home":
							echo "<li><span> Home </span></li>";
							echo "<li><a href='casa.php'>Per la tua casa</a></li>";
							echo "<li><a href='ristorante.php'>Per il tuo ristorante</a></li>";
							echo "<li><a href='catering.php'>Catering ed Eventi</a></li>";
						break;
					case "casa":
							echo "<li><a href='home.php'>Home</a></li>";
							echo "<li><span>Per la tua casa</span></li>";
							echo "<li><a href='ristorante.php'>Per il tuo ristorante</a></li>";
							echo "<li><a href='catering.php'>Catering ed Eventi</a></li>";
						break;
					case "ristorante":
							echo "<li><a href='home.php'>Home</a></li>";
							echo "<li><a href='casa.php'>Per la tua casa</a></li>";
							echo "<li><span>Per il tuo ristorante</span></li>";
							echo "<li><a href='catering.php'>Catering ed Eventi</a></li>";
						break;
					case "catering":
							echo "<li><a href='home.php'>Home</a></li>";
							echo "<li><a href='casa.php'>Per la tua casa</a></li>";
							echo "<li><a href='ristorante.php'>Per il tuo ristorante</a></li>";
							echo "<li><span>Catering ed Eventi</span></li>";
						break;
				}
				echo "</ul>";
				echo "<div class='search-container'>";
								echo "<form action='/search_page.php'>";
							  echo "<input id='search' type='search' name='search' placeholder='Cerca...'>";
								echo "<button type='submit'>Cerca</button>";
								echo "</form>";
			echo "</div>";
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
>>>>>>> 0c15203f0c86dc28066cc2a85f4cf166db1cd29a



	





}
	?>
