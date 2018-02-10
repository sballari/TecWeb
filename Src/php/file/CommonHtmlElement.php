<?php
require_once("../class/Manipulator.php");
require_once("../class/Factory.php");
require_once("../class/DBmanager.php");
require_once("../class/User.php");
require_once("../class/Product.php");
require_once("../class/Request.php");
require_once("../class/RetailOrder.php");
require_once("../class/MassiveOrder.php");
require_once("../class/Service.php");
class CommonHtmlElement{

	function createProductDiv($x,$ricerca=false ,$evidenzia=''){
		echo "<div class='product'>";
		echo "<h4>" . $this->evidenziaTesto($x->getName(), $evidenzia) . "</h4>";
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
					if (isset($_GET['operazione']) and $_GET['operazione']=='storia') $percorso = $percorso.">>Storia Ordini";
					if (isset($_GET['operazione']) and $_GET['operazione']=='prenotazione') $percorso = $percorso.">>Prenotazione";
					if (isset($_GET['operazione']) and $_GET['operazione']=='prodotti') $percorso = $percorso.">>Prodotti";
					if (!isset($_GET['operazione'])) $percorso = $percorso.">>Prenotazione";
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
		echo '<link rel="stylesheet" media="screen and (max-width:681px), only screen and (max-device-width:681px)"
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
			default:
					echo "<li><a href='home.php'>Home</a></li>";
					echo "<li><a href='casa.php'>Per la tua casa</a></li>";
					echo "<li><a href='ristorante.php'>Per il tuo ristorante</a></li>";
					echo "<li><a href='catering.php'>Catering ed Eventi</a></li>";
			break;
		}
		echo "<li>";
			echo "<div class='search-container'>";
			echo "<form action='search_page.php'>";
			echo "<input id='search' type='search' name='search' placeholder='Cerca prodotti...'>";
			echo "<button type='submit'>Cerca</button>";
			echo "</form>";
			echo "</div>";
		echo "</li>";
	 echo "</ul>";
	}

	public function createheader($page){
		echo "<a href='#top'><img  id='up_arrow' src='../../img/up_arrow.png' alt='Pulsante Torna Su'></a>";
		echo "<div id='accessBar'>
			<a href ='#content'>Vai al contenuto</a>
    	</div>";
		echo "<div class='header'>";
			echo "<a href='home.php'><img  class='logo' src='../../img/logo.png' alt='logo i tesori di Squitty'> </a>";
			echo "<a href='#headerSpace'> <img  id='hamburger' class='onlyMobile' src='../../img/menu-hamburger.png' alt='pulsante menu'> </a>";
			echo "<h1>I tesori di <span lang='it'>Squitty</span></h1>";
			echo "<div id='menu' class='onlyDesktop' >";
			$this->generateMenu($page);
		  echo "</div>";
			$this->printBricioleDiPane($page);
		echo "</div>";
	}

	public function createBottomHeader(){
		echo "<div class='header'>";
			echo "<a href='home.php'><img  class='logo' src='../../img/logo.png' alt='logo i tesori di Squitty'> </a>";
			echo "<a href='#top'> <img  id='close' class='onlyMobile' src='../../img/close.png' alt='pulsante menu'> </a>";
			echo "<h1>I tesori di <span lang='it'>Squitty</span></h1>";
		echo "</div>";
	}

	public function generateLogInLink($page){
		echo "<div class='logNav'>";
		echo "<h3 >AREA PERSONALE</h3>";
		echo "<ul>";
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


			default:
				echo "<li><a href='logIn.php'>Accedi</a></li>";
				echo "<li><a href='signUp.php'>Registrati</a></li>";
			break;
		}
		echo "</ul>";
		echo "</div>";
	}

	public function printContatti(){
	echo  "<div id='contatti'>";
    echo  "	<h3>CONTATTI</h3>";
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
		echo  "<div id='footer'>";
    echo  "    <p>";
    echo  "        Sito creato per il progetto didattico di Tecnologie per il Web da parte di: Gerta Llieshi, Alessio Gobbo, Dario Riccardo e Simone Ballarin.";
    echo  "    </p>";
    echo  "    <a href='sitemap.php'>sitemap</a>";
    echo  "</div>";
	}

	public function printMobileMenu($page){
	echo  "<div class='onlyMobile' id='mobileMenu'>";
    echo  "    <div id='headerSpace'> </div>";
		$this->createBottomHeader();
    echo  "    <div id='linkEsterni'>";
      			$this->generateMenu($page);
    echo  "    </div>";
    				$this->printInternalMenuMobile("$page");
						$this->generateLogInLink($page);
	echo "</div>";
	}

	public function printInternalMenu($page){
		echo "<div id ='internalNavBar' class='onlyDesktop' >";
				echo "<a href ='#content' class='aiuti'>Salta menu</a>";
        		$this->printListLinkInterni($page);
				$this->generateLogInLink($page);
    	echo "</div>";
	}
	public function printListLinkInterni($page){

		echo "<ul>";
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
							echo "<li><span>Prodotti</span></li>";
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
			case 'ConfirmPageImpiegato':
				if (isset($_SESSION['Email'])){
					echo "<li><a href='areaPersonaleImpiegato.php?operazione=ordini'>Ordini</a></li>";
					echo "<li><a href='areaPersonaleImpiegato.php?operazione=utenti'>Utenti</a></li>";
					echo "<li><a href='areaPersonaleImpiegato.php?operazione=prodotti'>Prodotti</a></li>";
				}
			break;
		}
			echo "	  <li><a href='#contatti'>Contatti</a></li>";
			echo "		</ul>";



	}
	public function printInternalMenuMobile($page){
		echo "<div id='mobileInterni'>";
		echo "<a href ='#content' class='aiuti'>Vai al contenuto</a>";
		echo "		<h3>LINK INTERNI</h3>";
		$this->printListLinkInterni($page);
		echo "</div>";
}
public function printRichiestaDettagliataDiv($Richiesta){
	$tipo = $Richiesta->getType();
	echo "<div class='contentElement'>";

	switch ($tipo){
		case 'Servizio':
				echo "<table summary='Nella tabella viene fornito i dettagli del Servizio selezionata. Ogni riga descrive una caratteristica del servizio.
				In ordine sono numero, nome, descrizione, numero personale richiesto, numero risorse richieste, indirizzo evento, data di ricezione della richiesta,
				data dell'evento, stato della richiesta>";
				echo "<caption>Dettagli Servizio numero ".$Richiesta->getKey()." </caption>";
				echo "<tr>
						<th scope = 'row' abbr='numero'>Numero Richiesta</th>
						<td>".$Richiesta->getKey()."</td>
					</tr>";
				echo "<tr>
					<th scope = 'row' abbr='nome'>Nome Servizio</th>
					<td>".$Richiesta->getService()->getName()."</td>
				</tr>";
				echo "<tr>
					<th scope = 'row' abbr='desc'>Descrizione</th>
					<td>".$Richiesta->getService()->getDesc()."</td>
				</tr>";
				echo "<tr>
					<th scope = 'row' abbr='staff'>Numero Personale</th>
					<td>".$Richiesta->getStaffNumber()."</td>
				</tr>";
			   echo "<tr>
					<th scope = 'row' abbr='risorse'>Risorse Richieste</th>
					<td>".$Richiesta->getResourceNeeded()."</td>
				</tr>";
			   echo "<tr>
					<th scope = 'row' abbr='luogo'>Luogo Evento</th>
					<td>".$Richiesta->getLocationAdress()."</td>
				</tr>";
			   echo "<tr>
					<th scope = 'row' abbr='ricezione'>Data e Ora Ricezione Richiesta</th>
					<td>".$Richiesta->getReiceveRequestDateTime()."</td>
				</tr>";
				echo "<tr>
					<th scope = 'row'>Data e Ora Evento</th>
					<td>".$Richiesta->getDeliveryDateTime()."</td>
				</tr>";
				echo "<tr>
					<th scope = 'row'>Stato</th>
					<td>".$Richiesta->getStatus()."</td>
				</tr>";
				echo "</table>";
		break;
		case "All_ingrosso":
			echo "<table summary='Nella tabella viene fornito i dettagli dell'ordine selezionato. Ogni riga descrive una caratteristica dell'ordine.
			In ordine sono numero, periodicit&agrave;, indirizzo di consegna, ora e data di ricezine, ora e data di consegna e stato.>";
			echo "<caption>Dettagli ordine all'ingrosso codice ".$Richiesta->getKey()." </caption>";
			echo "<tr>
						<th scope = 'row' abbr='numero'>Numero Richiesta</th>
						<td>".$Richiesta->getKey()."</td>
					</tr>";
			echo "<tr>
					<th scope = 'row'>Periodicit&agrave;</th>
					<td>".$Richiesta->getPeriodicity()."</td>
				</tr>";
			echo "<tr>
				<th scope = 'row' abbr='indirizzo'>Indirizzo di consegna</th>
				<td>".$Richiesta->getDeliveryAdress()."</td>
			</tr>";
			echo "<tr>
				<th scope = 'row' abbr='ricezione'>Data e ora ricezione</th>
				<td>".$Richiesta->getReiceveRequestDateTime()."</td>
			</tr>";
			echo "<tr>
				<th scope = 'row' abbr='consegna'>Data e ora di consegna</th>
				<td>".$Richiesta->getDeliveryDateTime()."</td>
			</tr>";
			echo "<tr>
				<th scope = 'row'>Stato</th>
				<td>".$Richiesta->getStatus()."</td>
			</tr>";
			echo "</table>";
			$this->printComposizioneOrdineTable($Richiesta);
		break;
		case "Al minuto":
			echo "<table summary='Nella tabella viene fornito i dettagli dell'ordine al minuto selezionato. Ogni riga descrive una caratteristica dell'ordine.
			In ordine sono chiave, note utente, data e ora di ricezione, data e ora di ritiro, stato.>";
			echo "<caption>Dettagli ordine all'ingrosso codice ".$Richiesta->getKey()." </caption>";
			echo "<tr>
						<th scope = 'row' abbr='numero'>Numero Richiesta</th>
						<td>".$Richiesta->getKey()."</td>
					</tr>";
			echo "<tr>
					<th scope = 'row'>Note Utente;</th>
					<td>".$Richiesta->getUserNote()."</td>
				</tr>";
			echo "<tr>
				<th scope = 'row' abbr='ricezione'>Data e ora ricezione</th>
				<td>".$Richiesta->getReiceveRequestDateTime()."</td>
			</tr>";
			echo "<tr>
				<th scope = 'row' abbr='consegna'>Data e ora di ritiro</th>
				<td>".$Richiesta->getDeliveryDateTime()."</td>
			</tr>";
			echo "<tr>
				<th scope = 'row'>Stato</th>
				<td>".$Richiesta->getStatus()."</td>
			</tr>";
			echo "</table>";
			$this->printComposizioneOrdineTable($Richiesta);
		break;
}
echo "</div>";
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
	public function printStoriaOrdiniServizio($req){
		$id=1;
		echo "<table>
		<tr>
		<th>Seleziona</th>
		<th>Codice</th>
		<th>Delivery date and hour </th>
		<th>Status</th>
		</tr>";
		foreach ($req as $x) {
			echo "<tr>";
			echo "<td>".$id."<input type='radio' name='request' value='request" . $id . "' ></td>";//TODO
			echo "<td>" . $x->getKey() . "</td>";
			echo "<td>" . $x->getDeliveryDateTime() . "</td>";
			echo "<td>" . $x->getStatus() . "</td>";
			echo "</tr>";
			$id++;
		}
		echo "</table>";
	}

public function printStoriaOrdiniAllIngrosso($req){
		$id=1;
		echo "<table>
		<tr>
		<th>Seleziona</th>
		<th>Codice</th>
		<th>Delivery date and hour</th>
		<th>Status</th>
		</tr>";
		foreach ($req as $x) {
			echo "<tr>";
			echo "<td>".$id."<input type='radio' name='request' value='request" . $id . "'/ ></td>";
			echo "<td>" . $x->getKey() . "</td>";
			echo "<td>" . $x->getDeliveryDateTime() . "</td>";
			echo "<td>" . $x->getStatus() . "</td>";
			echo "</tr>";
			$id++;
		}
		echo "</table>";
}

public function printStoriaOrdiniAlMinuto($req){
	$id=1;
	echo "<table>
		<tr>
		<th>Seleziona</th>
		<th>Codice</th>
		<th>Delivery date and hour </th>
		<th>Status</th>
		</tr>";
	foreach ($req as $x) {
		echo "<tr>";
		echo "<td>".$id."<input type='radio' name='request' value='request" . $id . "' ></td>";
		echo "<td>" . $x->getKey() . "</td>";
		echo "<td>" . $x->getDeliveryDateTime() . "</td>";
		echo "<td>" . $x->getStatus() . "</td>";
		echo "</tr>";
		$id++;
	}
	echo "</table>";
}

	public function printComposizioneOrdineTable($ordine){
		echo "<table summary='La tabella indica i prodotti che compongono l&#39;ordine richiesto. Ogni riga rappresenta un prodotto.
		I dati forniti in ogni riga sono, in ordine, nome del prodotto e quantit&agrave; ordinata' >";
		echo "<caption>Composizione Ordine</caption>";
		echo "
			<tr>
				<th scope='col' abbr='prod'>Nome Prodotto</th>
				<th scope='col' abbr= 'quantit&agrave;' >Quantit&agrave; ordinata</th>
			</tr>";

		$qta = $ordine->getProductsWithQta();
		foreach(array_keys($qta) as $p){
			echo "<tr>
					<td>".$p."</td>
					<td>".$qta[$p]."</td>
				</tr>";
		}
		echo "</table>";
}


public function printStoriaOrdini($t){
	$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
	$d->connect();
	$f = new Factory($d);
	$req = $f->getRequestList($_SESSION['Email']);
	$d->disconnect();
	echo "<div class='contentElement'>";
	echo "<form action = 'operationManager.php' method = 'POST'>";
	switch($t){
		case "Servizio":
			$this->printStoriaOrdiniServizio($req);
		break;

		case "All_ingrosso":
			$this->printStoriaOrdiniAllIngrosso($req);
		break;

		case "Al minuto":
			$this->printStoriaOrdiniAlMinuto($req);
			break;
	}
	echo "<button type='submit' name='annullaRichiesta' >Annulla la richiesta</button>";
	echo "<button type='submit' name='richiestaDettaglio' >Richiesta dettagliata</button>";
	echo "</form>";
	echo "</div>";
}


public function printTabellaOrdini($Type){
	$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
	$d->connect();
	$f = new Factory($d);
	$req = $f->getTypeRequestList($Type);
	$d->disconnect();
	echo "<div class='contentElement'>";
	echo "<form action = 'operationManagerImpiegato.php' method = 'POST'>";
	switch($t){
		case "Servizio":
			$this->printStoriaOrdiniServizio($req);
		break;

		case "All_ingrosso":
			$this->printStoriaOrdiniAllIngrosso($req);
		break;

		case "Al minuto":
			$this->printStoriaOrdiniAlMinuto($req);
			break;
	}
	echo "<button type='submit' name='cambiaStato' >Cambia stato</button>";
	echo "<button type='submit' name='cancellaRichiesta' >Cancella la richiesta</button>";
	echo "<button type='submit' name='richiestaDettagliataImp' >Richiesta dettagliata</button>";
	echo "</form>";
	echo "</div>";
}


public function printTabellaUtenti($Type){
	require_once("../class/Factory.php");
	require_once("../class/DBmanager.php");
	require_once("../class/Manipulator.php");

	$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
	$d->connect();
	$f = new Factory($d);
	$usr = $f->getUserList($Type);
	echo "<div class='contentElement' >;
	echo "<form action = 'operationManagerImpiegato.php' method = 'POST'>";
	if($usr==false){
		echo "Something went wrong! Try again.";
	}
	else{
		echo "<div id='tabelaUtenti'>";
		echo "<table>
				<tr>
				<th>Seleziona</th>
				<th>Email</th>
				<th>Tipo utente</th>
				</tr>";
	$id = 1;
	foreach ($usr as $x) {
		echo "<tr>";
		echo "<td>".$id."<input type='radio' name='request' value='request" . $id . "' ></td>";
		echo "<td>" . $x->getEmail() . "</td>";
		echo "<td>" . $x->getUserType() . "</td>";
		echo "</tr>";
		$id++;
	}
	echo "</table>";
	echo "</div>";
	}
	echo "</br></br>";
	echo "<button type='submit' name='cancellaUtente'>Cancella l'utente</button>";
	echo "<button type='submit' name='utenteDettagliato'>Utente dettagliato</button>";
	echo "</form>";
	echo "</div>";
}


public function printTabellaProdotti($Type){
	require_once("../class/Factory.php");
	require_once("../class/DBmanager.php");
	$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
	$d->connect();
	$f = new Factory($d);
	$prod = $f->getProductList($Type);

	echo "<div id='formOrdini' class='contentElement'>";
	echo "<form action = 'operationManagerImpiegato.php' method = 'POST'>";
	echo "<button type='submit' name='aggiuntaProdotto'>Aggiungi un nuovo prodotto</button></br>";
	echo "</br></br>";
	echo "<table>
			<tr>
			<th>Seleziona</th>
			<th>Nome</th>
			</tr>";
	$id=1;
	foreach ($prod as $x) {
		echo "<tr>";
		echo "<td>".$id."<input type='radio' name='prodotto' value='prodotto" . $id . "' ></td>";
		echo "<td>" . $x->getName() . "</td>";
		echo "</tr>";
		$id++;
	}
	echo "</table>";
	echo "</br></br>";
	echo "<button type='submit' name='cancellaProdotto'>Cancella prodotto</button></br>";
	echo "</br></br>";
	echo "<button type='submit' name='modificaProdotto'>Modifica prodotto</button></br></br>";
	echo "</form>";
	echo "</div>";
}

public function printFormPrenotazione($usrType){
$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
$d->connect();
$f = new Factory($d);
$prod = $f->getProductList($usrType);
$d->disconnect();

echo "<div id='ordineForm' class='contentElement'>";
echo "<form action='operationManager.php' method='POST' >";
echo "<fieldset>";
if($usrType!=="Servizio"){
	echo "<legend>Lista prodotti</legend>";}
else{
	echo "<legend>Dati prenotazione</legend>";}
echo "</br>";
echo "<label for='listaProdotti'>Prodotto:</label>  ";
echo "<select name='listaProdotti'  required>";
echo "<option value=''>--</option>";
foreach ($prod as $x) {
	echo "<option value='" . $x->getName() . "'>" . $x->getName() . "</option>";
}
echo "</select>";
echo "</br>";

switch($usrType ){
	case "Al minuto":
		echo "<label for='numeroProdotti'>Numero prodotti:</label><input type='number' name='numeroProdotti' required>";
		echo "<button type='submit' name='nuovoProd'>Inserisci prodotto</button>";
		echo "</br>";
		echo "</fieldset>";
		echo "</form>";
		echo "<form action='operationManager.php' method='POST' >";
		echo "<fieldset>";
		echo "<legend>Dati prenotazione</legend>";
		echo "</br>";
		echo "<label for='decrizioneUtente'>Descrizione utente:</label><textarea name='decrizioneUtente' rows='5' cols='30'>Torta di compleanno con la scrittura Buon compleanno.</textarea></br></br>";

		break;

	case "All_ingrosso":
		echo "<label for='numeroProdotti'>Numero prodotti:</label><input type='number' name='numeroProdotti' required>";
		echo "</br>";
		echo "<button type='submit' name='nuovoProd'>Inserisci prodotto</button>";
		echo "</br>";
		echo "</fieldset>";
		echo "</form>";
		echo "<form action='operationManager.php' method='POST' >";
		echo "<fieldset>";
		echo "<legend>Dati prenotazione</legend>";
		echo "</br>";
		echo "<label for ='indirizzoConsegna'>Indirizzo consegna:</label><input type='text' name='indirizzoConsegna' required>";
		echo "</br>";
		echo "<label for='periodicita'>Periodicita:</label><select name='periodicita' required>";

		echo "<option value=''>--</option>";
		echo "<option value='settimanale'>settimanale </option>";
		echo "<option value='mensile'>mensile</option>";
		echo "</select>";
		echo "</br>";
		break;

	case "Servizio":
		echo "<label for='personaleRichiesto'>Personale richiesto:</label><input type='number' name='personaleRichiesto' required>";
		echo "</br>";
		echo "<label for='risorseNecessarie'>Risorse necessarie:</label><textarea name='risorseNecessarie' rows='5' cols='30' required> 5 tavole, 20 sedie. </textarea>";
		echo "</br>";
		echo "<label for='indirizzoEvento'>Indirizzo evento:</label><input type='text' name='indirizzoEvento' required>";
		echo "</br>";
		break;
}
echo "<label for='dataRitiro'>Data ritiro/consegna/evento:</label><input type='text' name='dataRitiro' placeholder='YYYY-MM-DD' required>";
echo "</br>";
echo "<label for='oraRitiro'>Ora ritiro/consegna/evento(da 0 a 24):</label><input type='text' name='oraRitiro' placeholder='HH:MM:SS' required>";
echo "</br>";
echo "<button type='submit' name='prenota'>Prenota</button>";
echo "</br>";
echo "</fieldset>";
echo "</form>";
echo "</div>";
}


public function printTabelaProdottiScelti($usrType){
	if(($usrType=="Al minuto") || ($usrType=="All_ingrosso")){
		echo "<div id='prodScelti'>";
		echo "Fino adesso ai scelto i seguenti prodotti:";
		echo "</br>";
		echo "<table id='outputTable'>
			<tr>
			<th>Nr.</th>
			<th>Nome</th>
			</tr>";
		$c = $_SESSION['contatore'];
		for($i=1; $i<=$c; $i++){
			echo "<tr>";
			echo "<td>".$_SESSION[$_SESSION['listaProdotti'.$i]]."</td>";
			echo "<td>".$_SESSION['listaProdotti'.$i]."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
	}
}

public function printOperationElement($operazione, $usrType){
	switch($operazione){
		case "prenotazione":
			$this->printFormPrenotazione($usrType);
			break;
		case "storia":
			$this->printStoriaOrdini($usrType);
			break;
		case "prodotti":
			$this->printListaProdotti($usrType);
			break;
	}
}


public function printFormCategorie(){
	echo "<p>Scegli le categorie dei ordini che vuoi visualizzare.</p>";
	echo "<div id='formOrdini'>";
	echo "<form action = 'operationManagerImpiegato.php' method = 'POST'>";
	echo "<input type='checkbox' name='Al_minuto' value='Al minuto' checked>Al minuto</br>";
	echo "<input type='checkbox' name='All_ingrosso' value='All_ingrosso' checked>All'ingrosso</br>";
	echo "<input type='checkbox' name='Servizio' value='Servizio' checked>Servizio</br></br>";
	echo "<input type='submit' name='visualizzaOrdini' value='Visualizza Ordini'></br></br>";
	echo "</form>";
	echo "</div>";
}

public function printOperationElementImpiegato($operazione, $Type){
	switch($operazione){
		case "ordini":
			$this->printTabellaOrdini($Type);
			break;
		case "utenti":
			$this->printTabellaUtenti($Type);
			break;
		case "prodotti":
			$this->printTabellaProdotti($Type);
			break;
	}
}

}
?>
