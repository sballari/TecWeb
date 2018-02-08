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
		echo "<a href='#top'><img  id='up_arrow' src='../../img/up_arrow.png' alt='pulsante torna su'></a>";
		echo "</div>";
	}
	function evidenziaTesto($input, $par){
			return $newTesto =str_ireplace($par,
			 "<mark >".strtoupper($par)."</mark>",
			 $input);
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
			default:
					echo "<li><a href='home.php'>Home</a></li>";
					echo "<li><a href='casa.php'>Per la tua casa</a></li>";
					echo "<li><a href='ristorante.php'>Per il tuo ristorante</a></li>";
					echo "<li><a href='catering.php'>Catering ed Eventi</a></li>";
			break;
		}
	}

	public function createheader($page){
		echo "<div id='header'>";
			echo "<a href='home.php'><img  id='logo' src='../../img/logo.png' alt='logo i tesori di Squitty'> </a>";
			echo "<a href='#headerSpace'> <img  id='hamburger' class='onlyMobile' src='../../img/menu-hamburger.png' alt='pulsante menu'> </a>";
			echo "<h1>I tesori di <span lang='it'>Squitty</span></h1>";
			echo "<div id='menu' class='onlyDesktop' >";
			$this->generateMenu($page);
				echo "<div class='search-container'>";
								echo "<form action='search_page.php'>";
							  	echo "<input id='search' type='search' name='search' placeholder='Cerca prodotti...'>";
								echo "<button type='submit'>Cerca</button>";
								echo "</form>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	}

	public function generateLogInLink($page){
		echo  "    <div id='logNav'>";
		echo "<h3 >AREA PERSONALE</h3>";
		echo "<ul>";
		switch($page){
			case "logIn":
				echo "<li><span lang='en'>Log in</span></li>";
				echo "<li><a href='signUp.php' lang='en'>Sign up</a></li>";
			break;
			case "signUp":
				echo "<li><a href='logIn.php' lang='en'>Log in</a></li>";
				echo "<li><span lang='en'>Sign up</span></li>";
			break;
			case "account":
				echo "		<li><a href='areaPersonale.php?operazione=logout'>Log out</a></li>";
				echo "		<li><a href='areaPersonale.php?operazione=closeaccount'>Close account</a></li>";
			break;
			default:
				echo "<li><a href='logIn.php' lang='en'>Log in</a></li>";
				echo "<li><a href='signUp.php' lang='en'>Sign up</a></li>";
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
    echo  "            <li>mail: info@pasticceriaSquitty.com</li>";
    echo  "            <li>tel: 0421 5841204</li>";
    echo  "            <li>fax: 0421 7493729</li>";
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
    echo  "    <div id='linkEsterni'>";
      			$this->generateMenu($page);
    echo  "    </div>";
    				$this->printInternalMenuMobile("$page");
						$this->generateLogInLink($page);
    echo  "    <a href='#top'>
									<div>
										<img  id='up_arrow' src='../../img/up_arrow.png' alt='Pulsante Torna Su'>
										<p> Torna Su </p>
									</div>
							 </a>";
    echo  "</div>";
	}
	public function printInternalMenu($page){
		echo "<div id ='internalNavBar' class='onlyDesktop' >";
        $this->printListLinkInterni($page);
				$this->generateLogInLink($page);
    echo "</div>";
	}
	public function printListLinkInterni($page){
		echo "		<ul>";
		switch($page){
			case "home":
					echo "<li><a href='#storia'>Storia</a></li>";
					echo "<li><a href='#negozio'>Negozio</a></li>";
					echo "<li><a href='#stabilimento'>Stabilimento</a></li>";
			break;
			case "casa":
					echo "<li><a href='#productlist'>Prodotti ordinabili</a></li>";
					// echo "<li><a href='#contatti'>Contatti</a></li>";
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
					echo "<form action='' method='GET'>";
					//echo "		<li><button type='submit' name='operazione' value='prenotazione'>Prenotazione</button></li>";
					echo "		<li><a href='areaPersonale.php?operazione=prenotazione'>Prenotazione</a></li>";
					echo "		<li><a href='areaPersonale.php?operazione=storia'>Storia dei ordini</a></li>";
					echo "		<li><a href='areaPersonale.php?operazione=prodotti'>Prodotti</a></li>";

					echo "</form>";
			break;
		}
			echo "	  <li><a href='#contatti'>Contatti</a></li>";
			echo "		</ul>";


	}
	public function printInternalMenuMobile($page){
		echo "<div id='mobileInterni'>";
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
public function printListaProdotti($usrType){
	$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
	$d->connect();
	$f = new Factory($d);
	$prod = $f->getProductList($usrType);
	foreach ($prod as $x) {
		$this->createProductDiv($x);
	}
}
	public function printStoriaOrdiniServizio($req){
		$id=0;
		echo "<table>
		<tr>
		<th>Seleziona</th>
		<th>Codice Richiesta</th>
		<th>Nome del Prodotto</th>

		<th>MassiveOrder delivery date and hour </th>
		<th>MassiveOrder status</th>
		</tr>";
		foreach ($req as $x) {
			$id++;
			echo "<tr>";
			echo "<td>".$id."<input type='checkbox' name='request" . $id . "' value='request" . $id . "' ></td>";//TODO
			echo "<td>" . $x->getKey() . "</td>";
			echo "<td>" . $x->getService()->getName() . "</td>";

			echo "<td>" . $x->getDeliveryDateTime() . "</td>";
			echo "<td>" . $x->getStatus() . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}




public function printStoriaOrdiniAllIngrosso($req){
		$id=0;
		echo "<table>
		<tr>
		<th>Seleziona</th>
		<th>MassiveOrder codice</th>
		<th>MassiveOrder product's (number) and name</th>
		<th>MassiveOrder delivery date and hour </th>
		<th>MassiveOrder status</th>
		</tr>";
		foreach ($req as $x) {
			$id++;
			echo "<tr>";
			echo "<td>".$id."<input type='checkbox' name='request" . $id . "' value='request" . $id . "'/ ></td>";
			echo "<td>" . $x->getKey() . "</td>";

			$prodArr=$x->getProducts();
			$length=count($prodArr);
			$prodNumArr = array();

			for($i=0; $i<$length; $i++){
				$l=0;
				$name=$prodArr[$i]->getName();
				$pos=0;
				if($prodArr[$i] != NULL){
				for($j=0; $j<$length; $j++) {
					if($prodArr[$j]!= NULL){
						if($name == $prodArr[$j]->getName()){
							$l++;
							$prodArr[$j]=NULL;
							$pos=$j;
						}
						else{
							break;
						}
					}
				}
				$prodNumArr[$name]= "".$l;
				}
				$i=$pos;
			}
			echo "<td>";
			foreach ($prodNumArr as $key=>$value) {
				echo "(".$value.")  ".$key;
				echo "</br>";
			}
			echo "</td>";

			echo "<td>" . $x->getDeliveryDateTime() . "</td>";
			echo "<td>" . $x->getStatus() . "</td>";
			echo "</tr>";
		}
		echo "</table>";
}

public function printStoriaOrdiniAlMinuto($req){
	$id=0;
	echo "<table>
		<tr>
		<th>Seleziona</th>
		<th>ReTailOrder codice</th>
		<th>RetailOrder product's(number) and name</th>


		<th>ReTailOrder delivery date and hour </th>
		<th>ReTailOrder status</th>
		</tr>";
	foreach ($req as $x) {
		$id++;
		echo "<tr>";
		echo "<td>".$id."<input type='checkbox' name='request" . $id . "' value='request" . $id . "' ></td>";
		echo "<td>" . $x->getKey() . "</td>";
		$prodArr=$x->getProducts();
		$length=count($prodArr);
		$prodNumArr = array();

		for($i=0; $i<$length; $i++){
			$l=0;
			$name=$prodArr[$i]->getName();
			$pos=0;
			if($prodArr[$i] != NULL){
			for($j=0; $j<$length; $j++) {
				if($prodArr[$j]!= NULL){
					if($name == $prodArr[$j]->getName()){
						$l++;
						$prodArr[$j]=NULL;
						$pos=$j;
					}
					else{
						break;
					}
				}
			}
			$prodNumArr[$name]= "".$l;
			}
			$i=$pos;
		}
		echo "<td>";
		foreach ($prodNumArr as $key=>$value) {
			echo "(".$value.")  ".$key;
			echo "</br>";
		}
		echo "</td>";
		
		echo "<td>" . $x->getDeliveryDateTime() . "</td>";
		echo "<td>" . $x->getStatus() . "</td>";
		echo "</tr>";
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

echo "<label for='listaProdotti'>Prodotto:</label>  ";
echo "<select name='listaProdotti'  required>";
echo "<option value=''>--</option>";
foreach ($prod as $x) {
	echo "<option value='" . $x->getName() . "'>" . $x->getName() . "</option>";
}
echo "</select>";
echo "</br></br>";

switch($usrType ){
	case "Al minuto":
		echo "<label for='numeroProdotti'>Numero prodotti:</label><input type='number' name='numeroProdotti' required>";
		echo "<button type='submit' name='nuovoProd'>Inserisci prodotto</button>";
		echo "</fieldset>";
		echo "</form>";
		echo "<form action='operationManager.php' method='POST' >";
		echo "<fieldset>";
		echo "<legend>Dati prenotazione</legend>";

		echo "<label for='decrizioneUtente'>Descrizione utente:</label><textarea name='decrizioneUtente' rows='5' cols='30'>Torta di compleanno con la scrittura Buon compleanno.</textarea></br></br>";

		break;

	case "All_ingrosso":
		echo "<label for='numeroProdotti'>Numero prodotti:</label><input type='number' name='numeroProdotti' required>";

		echo "<button type='submit' name='nuovoProd'>Inserisci prodotto</button>";
		echo "</fieldset>";
		echo "</form>";
		echo "<form action='operationManager.php' method='POST' >";
		echo "<fieldset>";
		echo "<legend>Dati prenotazione</legend>";

		echo "<label for ='indirizzoConsegna'>Indirizzo consegna:</label><input type='text' name='indirizzoConsegna' required>";

		echo "<label for='periodicita'>Periodicita:</label><select name='periodicita' required>";

		echo "<option value=''>--</option>";
		echo "<option value='settimanale'>settimanale </option>";
		echo "<option value='mensile'>mensile</option>";
		echo "</select>";

		break;

	case "Servizio":
		echo "<label for='personaleRichiesto'>Personale richiesto:</label><input type='number' name='personaleRichiesto' required>";

		echo "<label for='risorseNecessarie'>Risorse necessarie:</label><textarea name='risorseNecessarie' rows='5' cols='30' required> 5 tavole, 20 sedie. </textarea>";

		echo "<label for='indirizzoEvento'>Indirizzo evento:</label><input type='text' name='indirizzoEvento' required>";

		break;
}
echo "<label for='dataRitiro'>Data ritiro/consegna/evento:</label><input type='text' name='dataRitiro' placeholder='YYYY-MM-DD' required>";

echo "<label for='oraRitiro'>Ora ritiro/consegna/evento(da 0 a 24):</label><input type='text' name='oraRitiro' placeholder='HH:MM:SS' required>";
echo "<button type='submit' name='prenota'>Prenota</button>";
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

}
?>
