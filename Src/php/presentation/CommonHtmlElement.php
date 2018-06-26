<?php
require_once("../services/Manipulator.php");
require_once("../services/Factory.php");
require_once("../services/DBmanager.php");
require_once("../models/User.php");
require_once("../models/Product.php");
require_once("../models/Request.php");
require_once("../models/RetailOrder.php");
require_once("../models/MassiveOrder.php");
require_once("../models/Service.php");
class CommonHtmlElement{
	public function createStatisticDiv(){
		echo "
			<div id='statD' class='bottomElement'>
			<h3>INFO NAVIGAZIONE</h3>
			<p id='pStat'>per poter visuallizare dati statistici &egrave; necessario abilitare <abbr lang='en' title = 'JavaScript'>JS</abbr></p>
			</div>

		";
	}
	function createProductDiv($x,$ricerca=false ,$evidenzia=''){
		echo "<div class='product'>";
		echo "<h3>" . $this->evidenziaTesto($x->getName(), $evidenzia) . "</h3>";
		$relativeImagePath = "'../../".$x->getImage()."'";
		echo "<img src=".$relativeImagePath." alt='".$x->getName()."'>";
		echo "<p> <strong>Ingredienti</strong>: " . $this->evidenziaTesto($x->getIngredients() ,$evidenzia). "</p>";
		echo "<p> <strong>Descrizione</strong>: " . $this->evidenziaTesto($x->getDesc(),$evidenzia) . "</p>";
		if ($ricerca==true) echo "<p> <strong>Tipo prodotto</strong>: " . $this->evidenziaTesto($x->getProductType(),$evidenzia) . "</p>";
		echo "</div>";
	}

	function evidenziaTesto($input, $par){
			return $newTesto =str_ireplace($par,
			 "<mark >".strtoupper($par)."</mark>",
			 $input);
	}

	public function printBricioleDiPane($page){
		switch ($page) {
			case 'home':
				$percorso = "<span lang='en'>Home</span>";
				break;
			case 'casa':
				$percorso = "<span>Casa</span>";
				break;
			case 'ristorante':
				$percorso = "<span>Ristorante</span>";
				break;
			case 'catering':
				$percorso = "<span>Catering ed Eventi</span>";
				break;
			case 'account':

				if (isset($_SESSION['Email'])){
					$percorso = "Area Personale";
					if (isset($_GET['operazione']) and $_GET['operazione']=='storia') $percorso = $percorso."&gt;&gt;Storia Ordini";
					if (isset($_GET['operazione']) and $_GET['operazione']=='prenotazione') $percorso = $percorso."&gt;&gt;Prenotazione";
					if (isset($_GET['operazione']) and $_GET['operazione']=='prodotti') $percorso = $percorso."&gt;&gt;Prodotti";
					if (!isset($_GET['operazione'])) $percorso = $percorso."&gt;&gt;Prenotazione";
				}
				else {$percorso = "Pagina di Errore";}
				break;
			case 'accountImpiegato':

					if (isset($_SESSION['Email'])){
						$percorso = "Area Personale Impiegato";
						if (isset($_GET['operazione']) and $_GET['operazione']=='ordini') $percorso = $percorso.">>Ordini";
						if (isset($_GET['operazione']) and $_GET['operazione']=='utenti') $percorso = $percorso.">>Utenti";
						if (isset($_GET['operazione']) and $_GET['operazione']=='prodotti') $percorso = $percorso.">>Prodotti";

					}
					else {$percorso = "Pagina di Errore";}
					break;
			case 'logIn':
				$percorso = "<span>Accedi</span>";
				break;
			case 'signUp':
				$percorso = "<span>Registrati</span>";
				break;
			case 'sitemap':
				$percorso = "<span lang='en'>SiteMap</span>";
			break;
			case 'search':
				$percorso = "Ricerca";
			break;
			case 'ConfirmPage':
				$percorso = "Pagina di Conferma";
			break;
			case 'richiestaDettagliata':
				$percorso = "Pagina di Richiesta Dettagliata";
			break;
			case 'ConfirmPageImpiegato':
				$percorso = "Pagina di Conferma Impiegato";
			break;
			case 'oggettoDettagliatoImpiegato':
				$percorso = "Pagina di Oggetto Dettagliato";
			break;
		}
		echo "
			<div id='briciole'>
				<p>Ti trovi in : ".$percorso."</p>
			</div>
		";
	}

	public function printHead($title, $description, $keyword){
		echo "<head>";
		echo "\n";
		echo '<title> '.$title.' - I tesori di Squitty </title>';
		//echo "\n";
		//echo '<meta name="title" content="'.$title.'" />';
		echo "\n";
		echo '<meta name="author" content="Simone Ballarin, Gerta Lleshi, Alessio Gobbo, Dario Riccardo"/>';
		echo "\n";
		echo '<meta name="description" content="'.$description.'" />';
		echo "\n";
		echo '<meta name="keywords" content="Squitty, pasticceria, dolci, '.$keyword.'"/>';
		echo "\n";
		//echo '<meta name="language" content="italian it"/>';
		//echo "\n";
		echo '<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>';
		echo "\n";
		echo '<link rel="stylesheet" media="screen" href="../../css/stile.css" type="text/css"/>';
		echo "\n";
		echo '<link rel="stylesheet" media="print" href="../../css/print.css" type="text/css" />';
		echo "\n";
		echo '<link rel="stylesheet" media="screen and (max-width:681px)" href="../../css/mobile.css" type="text/css" />';
		echo "<meta name='viewport' content='width=device-width, initial-scale=1.0' >";
		echo "\n";
		echo "<script src='../../js/gestioneCookie.js'></script>";
		echo '<!--[if lt IE 9]>
    			<script src="../../js/html5shiv.js"></script>
  		<![endif]-->';
		echo '</head>';
		echo "\n";
	}

	public function generateMenu($page, $boolS){
		if ($boolS) echo "<ul>";
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
			default:
					echo "<li><a href='home.php'>Home</a></li>";
					echo "<li><a href='casa.php'>Per la tua casa</a></li>";
					echo "<li><a href='ristorante.php'>Per il tuo ristorante</a></li>";
					echo "<li><a href='catering.php'>Catering ed Eventi</a></li>";
			break;
		}
		if ($boolS){
		echo "<li>";
			echo "<div id='search-contatiner' class='onlyDesktop'>";
			echo "<form action='search_page.php'>";
					echo "<label id='searchLabel' class='aiuti' for='searchInput'>Cerca </label>";
					echo "<input id='searchInput' type='search' name='search' placeholder='Cerca prodotti...'>";
					echo "<button id='searchButton' type='submit'>Cerca</button>";
			echo "</form>";
			echo "</div>";
		echo "</li>";
		}
		if ($boolS) echo "</ul>";
	}

	public function createheader($page){

		echo "<div id='accessBar'>
			<a href ='#content'>Vai al contenuto</a>
			<a href='#top'><img  id='up_arrow' src='../../img/up_arrow.png' alt='Pulsante Torna Su'></a>
    	</div>";
		echo "<div class='header'>";
			echo "<a href='home.php'><img  class='onlyDesktop logo' src='../../img/logo.png' alt='logo i tesori di Squitty'> </a>";
			echo "<h1>I tesori di <span lang='it'>Squitty</span></h1>";
			echo "<nav aria-label='primary' id='menu' class='onlyDesktop' >";
			$this->generateMenu($page, true);
		  echo "</nav >";
			$this->printBricioleDiPane($page);
		echo "</div>";
	}

	public function generateLogInLink($page, $mobile=false){
		if (!$mobile) echo "<div class='logNav'>";
		else echo "<li>";
			echo "<h1>AREA PERSONALE</h1>";
		if ($mobile) echo "</li>";
		else echo "<ul>";

		switch($page){
			case "logIn":
				echo "<li><span>Accedi</span></li>";
				echo "<li><a href='signUp.php' lang='en'>Registrati</a></li>";
			break;
			case "signUp":
				echo "<li><a href='logIn.php'>Accedi</a></li>";
				echo "<li><span>Registrati</span></li>";
			break;
			case "account":
				if (isset($_SESSION['Email'])){
					echo "		<li><a href='areaPersonale.php?operazione=logout'>Esci</a></li>";
					echo "		<li><a href='areaPersonale.php?operazione=closeaccount'>Elimina Account</a></li>";
				}
				else{
					echo "<li><a href='logIn.php'>Accedi</a></li>";
					echo "<li><a href='signUp.php'>Registrati</a></li>";
				}
			break;
			case "ConfirmPage":
				if (isset($_SESSION['Email'])){
					echo "		<li><a href='areaPersonale.php?operazione=logout'>Esci</a></li>";
					echo "		<li><a href='areaPersonale.php?operazione=closeaccount'>Elimina Account</a></li>";
				}
				else{
					echo "<li><a href='logIn.php'>Accedi</a></li>";
					echo "<li><a href='signUp.php'>Registrati</a></li>";
				}
			break;
			case "richiestaDettagliata":
				if (isset($_SESSION['Email'])){
					echo "		<li><a href='areaPersonale.php?operazione=logout'>Esci</a></li>";
					echo "		<li><a href='areaPersonale.php?operazione=closeaccount'>Elimina Account</a></li>";
				}
				else{
					echo "<li><a href='logIn.php'>Accedi</a></li>";
					echo "<li><a href='signUp.php'>Registrati</a></li>";
				}
			break;
			case "accountImpiegato":
				if (isset($_SESSION['Email'])){
					echo "		<li><a href='areaPersonaleImpiegato.php?operazione=logout'>Esci</a></li>";
					echo "		<li><a href='areaPersonaleImpiegato.php?operazione=closeaccount'>Elimina Account</a></li>";
				}
				else{
					echo "<li><a href='logIn.php'>Accedi</a></li>";
					echo "<li><a href='signUp.php'>Registrati</a></li>";
				}
			break;
			case "ConfirmPageImpiegato":
				if (isset($_SESSION['Email'])){
					echo "		<li><a href='areaPersonaleImpiegato.php?operazione=logout'>Esci</a></li>";
					echo "		<li><a href='areaPersonaleImpiegato.php?operazione=closeaccount'>Elimina Account</a></li>";
				}
				else{
					echo "<li><a href='logIn.php'>Accedi</a></li>";
					echo "<li><a href='signUp.php'>Registrati</a></li>";
				}
			break;
			case "oggettoDettagliatoImpiegato":
				if (isset($_SESSION['Email'])){
					echo "		<li><a href='areaPersonaleImpiegato.php?operazione=logout'>Esci</a></li>";
					echo "		<li><a href='areaPersonaleImpiegato.php?operazione=closeaccount'>Elimina Account</a></li>";
				}
				else{
					echo "<li><a href='logIn.php'>Accedi</a></li>";
					echo "<li><a href='signUp.php'>Registrati</a></li>";
				}
			break;

			default:

				if(isset($_SESSION['Email'])){

					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$f = new Factory($d);
					$u = $f->getUser($_SESSION['Email']);
			    $t = $u->getUserType();
					$d->disconnect();
			    if($t == "Impiegato"){
						echo "		<li><a href='areaPersonaleImpiegato.php'>Torna all'account</a></li>";
						echo "		<li><a href='areaPersonaleImpiegato.php?operazione=logout'>Esci</a></li>";
						echo "		<li><a href='areaPersonaleImpiegato.php?operazione=closeaccount'>Elimina Account</a></li>";
					}
					else{
						echo "    <li><a href='areaPersonale.php'>Torna all'account</a></li>";
						echo "		<li><a href='areaPersonale.php?operazione=logout'>Esci</a></li>";
						echo "		<li><a href='areaPersonale.php?operazione=closeaccount'>Elimina Account</a></li>";
					}
				}
				else{
				echo "<li><a href='logIn.php'>Accedi</a></li>";
				echo "<li><a href='signUp.php'>Registrati</a></li>";
				}
			break;
		}
		if (!$mobile) echo "</ul>";
		if (!$mobile) echo "</div>";
	}

	public function printContatti(){
	echo  "<div id='contatti' class='bottomElement'>";
    echo  "	<h2>CONTATTI</h2>";
    echo  "    <p>";
    echo  "        Sempre a vostra disposizione, ci potete trovare ai seguenti recapiti:";
    echo  "    </p>";
    echo  "        <ul>";
    echo  "            <li>negozio: via G. Stilton 44 Jesolo (VE) cap. 30016</li>";
    echo  "            <li>stabilimento: via dell’Innovazione 42 Jesolo (VE) cap. 30016</li>";
    echo  "            <li>mail:<a href ='mailto:info@pasticceriaSquitty'>info@pasticceriaSquitty.com</a></li>";
    echo  "            <li>tel:<a href ='tel:04215841204'>0421 5841204</a></li>";
    echo  "        </ul>";
  echo  "</div>";
	}

	public function printFooter(){
	echo  "<div id='footer' class='bottomElement'>";
    echo  "    <p>";
    echo  "        Sito creato per il progetto didattico di Tecnologie per il Web da parte di: Gerta Lleshi, Alessio Gobbo, Dario Riccardo e Simone Ballarin.";
    echo  "    </p>";
    echo  "    <a href='sitemap.php'>sitemap</a>";
    echo  "</div>";
	}

	public function printMobileMenu($page){
	echo  "<nav  aria-label='secondary' class='onlyMobile' id='mobileMenu'>";
	echo  "<div id='menuToggle'>";
	echo  "<input id='ckM' type='checkbox' />";
	echo "<label id='MenuCheckbox' class='aiuti' for='ckM'>Spunta per il menu</label>";
	echo  "
				<span></span>
				<span></span>
				<span></span>
	";
	echo "<ul id='mobileMenuList'>";
		echo "<li><a href ='#content' class='aiuti'>Skip</a></li>";
    	$this->generateMenu($page,false);
    	$this->printInternalMenuMobile($page);
		$this->generateLogInLink($page, true);
	echo "</ul>";
	echo "</div>";
	echo "</nav>";
	}

	public function printInternalMenu($page){
		echo "<div id ='internalNavBar' class='onlyDesktop' >";
		echo "<a href ='#content' class='aiuti'>Salta menu</a>";
  	$this->printListLinkInterni($page);
		$this->generateLogInLink($page);
    echo "</div>";
	}
	public function printListLinkInterni($page, $mob = false){

		if (!$mob) echo "<ul>";
		switch($page){
			case "home":
					echo "<li><a href='#storia'>Storia</a></li>";
					echo "<li><a href='#negozio'>Negozio</a></li>";
					echo "<li><a href='#stabilimento'>Stabilimento</a></li>";
			break;
			case "casa":
					echo "<li><a href='#productlist'>Prodotti ordinabili</a></li>";

			break;
			case "catering":
					echo "<li><a href='#info'>Info</a></li>";
					echo "<li><a href='#productlist'>Prodotti ordinabili</a></li>";
			break;
			case "ristorante":
					echo "<li><a href='#info'>Info</a></li>";
					echo "<li><a href='#productlist'>Prodotti ordinabili</a></li>";
			break;
			case "logIn":
					echo "<li><a href='#info'>Info</a></li>";
					echo "<li><a href='#form'>Form Accesso</a></li>";
			break;
			case "signUp":
					echo "<li><a href='#info'>Info</a></li>";
					echo "<li><a href='#form'>Creazione utente</a></li>";
			break;
			case "account":
					if (isset($_SESSION['Email'])){
						//$percorso = "Area Personale";

						if (isset($_GET['operazione']) and $_GET['operazione']=='storia') {
							echo "<li><a href='areaPersonale.php?operazione=prenotazione'>Prenotazione</a></li>";
							echo "<li><span>Storia dei ordini</span></li>";
							echo "<li><a href='areaPersonale.php?operazione=prodotti'>Prodotti</a></li>";
						}
						if (isset($_GET['operazione']) and $_GET['operazione']=='prenotazione') {
							echo "<li><span>Prenotazione</span></li>";
							echo "<li><a href='areaPersonale.php?operazione=storia'>Storia dei ordini</a></li>";
							echo "<li><a href='areaPersonale.php?operazione=prodotti'>Prodotti</a></li>";
						}
						if (isset($_GET['operazione']) and $_GET['operazione']=='prodotti') {
							echo "<li><a href='areaPersonale.php?operazione=prenotazione'>Prenotazione</a></li>";
							echo "<li><a href='areaPersonale.php?operazione=storia'>Storia dei ordini</a></li>";
							echo "<li><span>Prodotti</span></li>";
						}
						if (!isset($_GET['operazione'])){
							echo "<li><span>Prenotazione</span></li>";
							echo "<li><a href='areaPersonale.php?operazione=storia'>Storia dei ordini</a></li>";
							echo "<li><a href='areaPersonale.php?operazione=prodotti'>Prodotti</a></li>";
						}
					}
			break;

			case "accountImpiegato":
					if (isset($_SESSION['Email'])){
						$percorso = "Area Personale Impiegato";

						if (isset($_GET['operazione']) and $_GET['operazione']=='utenti') {
							echo "<li><a href='areaPersonaleImpiegato.php?operazione=ordini'>Ordini</a></li>";
							echo "<li><span>Utenti</span></li>";
							echo "<li><a href='areaPersonaleImpiegato.php?operazione=prodotti'>Prodotti</a></li>";
						}
						if (isset($_GET['operazione']) and $_GET['operazione']=='ordini') {
							echo "<li><span>Ordini</span></li>";
							echo "<li><a href='areaPersonaleImpiegato.php?operazione=utenti'>Utenti</a></li>";
							echo "<li><a href='areaPersonaleImpiegato.php?operazione=prodotti'>Prodotti</a></li>";
						}
						if (isset($_GET['operazione']) and $_GET['operazione']=='prodotti') {
							echo "<li><a href='areaPersonaleImpiegato.php?operazione=ordini'>Ordini</a></li>";
							echo "<li><a href='areaPersonaleImpiegato.php?operazione=utenti'>Utenti</a></li>";
							echo "<li><span>Prodotti</span></li>";
						}
						if (!isset($_GET['operazione'])){
							echo "<li><a href='areaPersonaleImpiegato.php?operazione=ordini'>Ordini</a></li>";
							echo "<li><a href='areaPersonaleImpiegato.php?operazione=utenti'>Utenti</a></li>";
							echo "<li><a href='areaPersonaleImpiegato.php?operazione=prodotti'>Prodotti</a></li>";
						}
					}
					break;

			case "sitemap":
					echo "<li><a href='#sitemap'>Sitemap</a></li>";
			break;
			case 'search':
				echo "<li><a href='#productlist'>Prodotti trovati</a></li>";
			break;
			case 'ConfirmPage':
				if (isset($_SESSION['Email'])){
					echo "<li><a href='areaPersonale.php?operazione=prenotazione'>Prenotazione</a></li>";
					echo "<li><a href='areaPersonale.php?operazione=storia'>Storia dei ordini</a></li>";
					echo "<li><a href='areaPersonale.php?operazione=prodotti'>Prodotti</a></li>";
				}
			break;
			case 'richiestaDettagliata':
				if (isset($_SESSION['Email'])){
					echo "<li><a href='areaPersonale.php?operazione=prenotazione'>Prenotazione</a></li>";
					echo "<li><a href='areaPersonale.php?operazione=storia'>Storia dei ordini</a></li>";
					echo "<li><a href='areaPersonale.php?operazione=prodotti'>Prodotti</a></li>";
				}
			break;
			case 'ConfirmPageImpiegato':
				if (isset($_SESSION['Email'])){
					echo "<li><a href='areaPersonaleImpiegato.php?operazione=ordini'>Ordini</a></li>";
					echo "<li><a href='areaPersonaleImpiegato.php?operazione=utenti'>Utenti</a></li>";
					echo "<li><a href='areaPersonaleImpiegato.php?operazione=prodotti'>Prodotti</a></li>";
				}
			break;
			case 'oggettoDettagliatoImpiegato':
				if (isset($_SESSION['Email'])){
					echo "<li><a href='areaPersonaleImpiegato.php?operazione=ordini'>Ordini</a></li>";
					echo "<li><a href='areaPersonaleImpiegato.php?operazione=utenti'>Utenti</a></li>";
					echo "<li><a href='areaPersonaleImpiegato.php?operazione=prodotti'>Prodotti</a></li>";
				}
			break;
		}
			echo "	  <li><a href='#contatti'>Contatti</a></li>";
			if (!$mob) 	echo "		</ul>";



	}
	public function printInternalMenuMobile($page){
		echo "	<li><h1>LINK INTERNI</h1></li>";
		$this->printListLinkInterni($page, true);
}

public function printListaProdotti($Type){
	$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
	$d->connect();
	$f = new Factory($d);
	$prod = $f->getProductList($Type);
	foreach ($prod as $x) {
		$this->createProductDiv($x);
	}
	$d->disconnect();
}


}
?>
