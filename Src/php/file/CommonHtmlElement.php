<?php

class CommonHtmlElement{
	
	function _construct()
	{
	}

	public function createheader($page){
		echo "<div id='header'>";
			echo "<img  id='logo' src='img/logo.jpg' alt='logo i tesori di Squitty'>";
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
	
	
	public function generatelogin($type){
	
	
		session_start();
		if((!isset($_POST['email'])) || (!isset($_POST['password'])))
		{
		// OnSubmit display message!
			echo "<div>";
				echo "<form action='' target='_blank' method='POST'>";
					echo "<fieldset>";
						echo "<legend>Area di Login:</legend>";
						echo "Email:<br>";
						echo "<input type='email' name='email' placeholder='mickey.mouse@gmail.com'>";
						echo "<br>";
						echo "Password:<br>";
						echo "<input type='password' name='password' placeholder='insert your password'>";
						echo "<br><br>";
						echo "<input type='submit' value='Login'>";
					echo "</fieldset>";
				echo "</form>";
			echo "</div>";
		}
		else
		{
		
			if(file_exists("Authenticator.php"))
			{
				require_once "Authenticator.php";
			}
			else
			{
				echo "Error: file does not esist.";
				exit;
			}
			$m = new Authenticator();		// la connessione con i lDB verra fatta ogni volta che viene creato un oggetto DBmanager.
			$u = $m->validateUser($_POST['email'], $_POST['password']);
			if($u==NULL)
			{
				echo "Wrong email or password!";
				echo "Insert your data again. Please remember that password must contain at least 8 caracters and at most 12 caracters.";
			
			}
			else
			{
				header("Location: http://www.itesoridisquitty.it/account.php");
			
			}
	
		}
	}

}
	?>

