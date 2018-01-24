<?php

class CommonHtmlElement{




	function __construct()
	{
	}




	public function createheader($page){
	echo "<div id='header'>";
		echo "<img  id='logo' src='../../img/logo.jpg' alt='logo i tesori di Squitty'>";
		echo "<h1>I tesori di <span lang='en'>Squitty</span></h1>";
		echo "<div id='login' >";
		if($page=="loginSignup"){
			echo "<ul>";
				echo "<li><span>Log in</span></li>";
				echo "<li><span>Sign up</span></li>";
			echo "</ul>";
		}
		else{
			echo "<ul>";
				echo "<li><a href='loginSignup.php'>Log in</a></li>";
				echo "<li><a href='loginSignup.php'>Sign up</a></li>";
			echo "</ul>";
		}
		echo "</div>";
		echo "<div id='menu' >";
			switch($page){
				case "loginSignup":
					echo "<ul>";
						echo "<li><a href='home.php'>Home</a></li>";
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








}
	?>
