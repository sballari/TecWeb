<?php

class CommonHtmlElement{




	function __construct()
	{
	}

	function createProductDiv($x){
		echo "<div class='product'>";
		echo "<h4>" . $x->getName() . "</h4>";
		$relativeImagePath = "'../../".$x->getImage()."'";
		echo "<img src=".$relativeImagePath." alt='".$x->getName()."'>";
		echo "<p> <strong>Ingredienti</strong>: " . $x->getIngredients() . "</p>";
		echo "<p> <strong>Descrizione</strong>: " . $x->getDesc() . "</p>";
		echo "<a href='#top'><img  id='up_arrow' src='../../img/up_arrow.png' alt='pulsante torna su'></a>";
		echo "</div>";
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
		echo '<link rel="stylesheet" media="handheld,screen and (max-width:681px), only screen and (max-device-width:681px)"
		 			href="../../css/mobile.css" type="text/css" />';
		echo "\n";
		echo '</head>';
		echo "\n";
	}

	public function generateMenu($page){
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
			case "loginSignup":
					echo "<li><a href='home.php'>Home</a></li>";
					echo "<li><a href='casa.php'>Per la tua casa</a></li>";
					echo "<li><a href='ristorante.php'>Per il tuo ristorante</a></li>";
					echo "<li><a href='catering.php'>Catering ed Eventi</a></li>";
			break;
		}
	}

	public function createheader($page){
		echo "<div id='header'>";
			echo "<img  id='logo' src='../../img/logo.png' alt='logo i tesori di Squitty'>";
			echo "<a href='#headerSpace'> <img  id='hamburger' class='onlyMobile' src='../../img/menu-hamburger.png' alt='pulsante menu'> </a>";
			echo "<h1>I tesori di <span lang='it'>Squitty</span></h1>";
			echo "<div id='menu' class='onlyDesktop' >";
			$this->generateMenu($page);
				echo "<div class='search-container'>";
								echo "<form action='/search_page.php'>";
							  echo "<input id='search' type='search' name='search' placeholder='Cerca...'>";
								echo "<button type='submit'>Cerca</button>";
								echo "</form>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	}

	public function generateLogInLink($page){
		echo "<h3 >AREA PERSONALE</h3>";
		echo "<ul>";
		if($page=="loginSignup"){
				echo "<li><span>Log in</span></li>";
				echo "<li><span>Sign up</span></li>";
		}
		else{
				echo "<li><a href='loginSignup.php'>Log in</a></li>";
				echo "<li><a href='loginSignup.php'>Sign up</a></li>";
		}
		echo "</ul>";
	}


}
?>
