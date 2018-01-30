<!DOCTYPE HTML>
<html lang ="it">
<head>
    <title> Account per il cliente - I tesori di <span lang="en">Squitty</span> </title>
    <meta name="title" content="Trama" >
    <meta name="author" content="Simone Ballarin">
    <meta name="description" content="trama della serie <abbr>TBBT</abbr>" >
    <meta name="keywords" content="curiosita" >
    <meta name="language" content="italian it">
    <meta http-equiv="Content-Type" content="text/html; =charset=utf-8">
    <link rel="stylesheet" href="../../css/stile.css">
</head>
<body>
    <div id="accessBar">
    </div>

	<div id="header">
			<img  id="logo" src="../../img/logo.jpg" alt="logo i tesori di Squitty">
			<h5>I tesori di <span lang="en">Squitty</span></h5>
			<form action = "" method = "POST">
					<input type="submit" name="prodotti" value='Prodotti al minuto'>
					<input type="submit" name="storia" value='Storia dei ordini'>
					<input type="submit" name="prenotazione" value='Prenotazione'>
					<input type="submit" name="logout" value='Log Out'>
					<input type="submit" name="closeaccount" value='Close Account'>
			</form>
	</div>
			<?php
				session_start();
				echo "Welcome back " . $_SESSION['Email'];

				if(isset($_POST['prodotti'])){
					if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") && file_exists("../class/User.php") && file_exists("../class/Product.php")){
						require_once("../class/Factory.php");
						require_once("../class/DBmanager.php");
						require_once("../class/User.php");
						require_once("../class/Product.php");}
					else{
						echo "Error: One of the files does not esist.";
						exit;}

					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$f = new Factory($d);
					$u = $f->getUser($_SESSION['Email']);

					$t = $u->getUserType();
					$prod = $f->getProductList($t);

					foreach ($prod as $x) {
						echo "<div class='product'>";
						echo "<h4>" . $x->getName() . "</h4>";
						$relativeImagePath = "'../../".$x->getImage()."'";
						echo "<img src=".$relativeImagePath." alt='".$x->getName()."'>";
						echo "<p> Ingredienti:" . $x->getIngredients() . "</p>";
						echo "<p> Descrizione" . $x->getDesc() . "</p>";
						echo "</div>";
					}
				}


				if(isset($_POST['storia'])){
					if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") && file_exists("../class/User.php") && file_exists("../class/Service.php") && file_exists("../class/RetailOrder.php") && file_exists("../class/MassiveOrder.php")){
						require_once("../class/Factory.php");
						require_once("../class/DBmanager.php");
						require_once("../class/User.php");
						require_once("../class/Request.php");
						require_once("../class/RetailOrder.php");
						require_once("../class/MassiveOrder.php");
						require_once("../class/Service.php");
						}
					else{
						echo "Error: One of the files does not esist.";
						exit;}

					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$f = new Factory($d);
					$u = $f->getUser($_SESSION['Email']);
					$t = $u->getUserType();
					$req = $f->getRequestList($_SESSION['Email']);

					$id=0;
					echo "<div class='tabelaStoria'>";
					echo "<form action = '' method = 'POST'>";
					switch($t){
						case "Servizio":
							echo "<table>
							<tr>
							<th>Seleziona</th>
							<th>Request codice</th>
							<th>Request product name</th>
							<th>Request product image</th>
							<th>Request product description</th>
							<th>Request staff</th>
							<th>Request resources</th>
							<th>Request adress</th>
							<th>Request receive date and hour</th>
							<th>MassiveOrder delivery date and hour </th>
							<th>MassiveOrder status</th>
							</tr>";
							foreach ($req as $x) {
								$id++;
								echo "<tr>";
								echo "<td>".$id."<input type='checkbox' name='request" . $id . "' value='request" . $id . "' ></td>";
								echo "<td>" . $x->getKey() . "</td>";
								echo "<td>" . $x->getService()->getName() . "</td>";
								echo "<td>" . $x->getService()->getImage() . "</td>";
								echo "<td>" . $x->getService()->getDesc() . "</td>";
								echo "<td>" . $x->getStaffNumber() . "</td>";
								echo "<td>" . $x->getResourceNeeded() . "</td>";
								echo "<td>" . $x->getLocationAdress() . "</td>";
								echo "<td>" . $x->getReiceveRequestDateTime() . "</td>";
								echo "<td>" . $x->getDeliveryDateTime() . "</td>";
								echo "<td>" . $x->getStatus() . "</td>";
								echo "</tr>";
							}
							echo "</table>";
							break;

						case "All_ingrosso":
							echo "<table>
							<tr>
							<th>Seleziona</th>
							<th>MassiveOrder codice</th>
							<th>MassiveOrder product's (number) and name</th>

							<th>MassiveOrder periodicity</th>
							<th>MassiveOrder adress</th>
							<th>MassiveOrder receive date and hour</th>
							<th>MassiveOrder delivery date and hour </th>
							<th>MassiveOrder status</th>
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
								echo "<td>" . $x->getPeriodicity() . "</td>";
								echo "<td>" . $x->getDeliveryAdress() . "</td>";
								echo "<td>" . $x->getReiceveRequestDateTime() . "</td>";
								echo "<td>" . $x->getDeliveryDateTime() . "</td>";
								echo "<td>" . $x->getStatus() . "</td>";
								echo "</tr>";
							}
							echo "</table>";
							break;

						case "Al minuto":
							echo "<table>
								<tr>
								<th>Seleziona</th>
								<th>RetailOrder product's(number) and name</th>

								<th>RetailOrder user notes</th>
								<th>RetailOrder receive date and hour</th>
								<th>MassiveOrder delivery date and hour </th>
								<th>MassiveOrder status</th>
								</tr>";
							foreach ($req as $x) {
								$id++;
								echo "<tr>";
								echo "<td>".$id."<input type='checkbox' name='request" . $id . "' value='request" . $id . "' ></td>";

								$prodArr=$x->getProducts();
								$length=count($prodArr);
								$prodNumArr = array();

								for($i=0; $i<$length; $i++){
									$l=0;
									$name=$prodArr[$i]->getName();
									echo "".$name;
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
								echo "<td>" . $x->getUserNote() . "</td>";
								echo "<td>" . $x->getReiceveRequestDateTime() . "</td>";
								echo "<td>" . $x->getDeliveryDateTime() . "</td>";
								echo "<td>" . $x->getStatus() . "</td>";
								echo "</tr>";
							}
							echo "</table>";
							break;
					}
					echo "</br></br>";
					echo "Ricordati che una richiesta deve essere anullata almeno un giorno prima del suo ritiro.";
					echo "</br></br>";
					echo "<input type='submit' name='anullaRichiesta' value='Anulla la richiesta'>";
					echo "</br></br>";
					echo "</form>";
				}


				if(isset($_POST['anullaRichiesta'])){
					if(file_exists("../class/Factory.php") && file_exists("../class/Manipulator.php") && file_exists("../class/DBmanager.php") && file_exists("../class/User.php") && file_exists("../class/Service.php") && file_exists("../class/RetailOrder.php") && file_exists("../class/MassiveOrder.php")){
						require_once("../class/Factory.php");
						require_once("../class/Manipulator.php");
						require_once("../class/DBmanager.php");
						require_once("../class/User.php");
						require_once("../class/Request.php");
						require_once("../class/RetailOrder.php");
						require_once("../class/MassiveOrder.php");
						require_once("../class/Service.php");
						}
					else{
						echo "Error: One of the files does not esist.";
						exit;}

					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$f = new Factory($d);
					$m = new Manipulator($d);
					$u = $f->getUser($_SESSION['Email']);
					$t = $u->getUserType();
					$req = $f->getRequestList($_SESSION['Email']);
					$id=1;
					foreach($req as $x){
						$st="request" . $id . "";
						if(isset($_POST[$st])){
							$currentD = "".date("Y-m-d ");
							$deliveryD = "".$x->getDeliveryDateTime();
							if($deliveryD > $currentD){
								$b = $m->removeRequest($x->getKey(), $t);
								if($b==false){
									echo "Something went at removeRequest wrong try again!";
								}
								else{
									echo "The request has been sucessfully removed.";
								}
							}
							else{
								echo "Your too late to remove the request.";
							}
						}
						$id++;
					}
				}


				if(isset($_POST['closeaccount'])){
					if(file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/User.php")){
							require_once("../class/DBmanager.php");
							require_once("../class/Manipulator.php");
							require_once("../class/User.php");}
						else{
							echo "Error: One of the files does not esist.";
							exit;}

						$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
						$d->connect();
						$m = new Manipulator($d);
						$b = $m->removeUser($_SESSION['Email']);
						$diss=$d->disconnect();
						$_SESSION['Email'] = "";

						if($b==false){
							echo "Something went wrong. Please try closing your account again.";
						}
						else{
							header("Location: home.php");
						}
				}


				if(isset($_POST['logout'])){
					$_SESSION['Email'] = "";
					header("Location: home.php");
				}


				function clean_input($data) {
					$data = trim($data);
					$data = htmlentities($data);
					$data = strip_tags($data);
					return $data;
				}
				$numeroProdotti = $dataRitiro = $oraRitiro = "";
				$ErrNumeroProdotti = $ErrDataRitiro = $ErrOraRitiro = "";

				if(isset($_POST['prenota'])){
						//$dataRitiro = clean_input($_POST['dataRitiro']);
						//if (!preg_match("//", $dataRitiro)) {		//******** YOU HAVE TO FIX IT*******
							//$ErrDataRitiro = "Invalid date format";
						//}

						//$oraRitiro = clean_input($_POST['oraRitiro']);
						//if (!preg_match("//",$oraRitiro)) {		//******** YOU HAVE TO FIX IT*******
							//$ErrOraRitiro= "Invalid time format";
						//}
						//if(($ErrNumeroProdotti = "") && ($ErrDataRitiro = "") && ($ErrOraRitiro = "")){
					if(file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/Factory.php") && file_exists("../class/User.php") && file_exists("../class/Product.php") && file_exists("../class/Service.php") && file_exists("../class/RetailOrder.php") && file_exists("../class/MassiveOrder.php")){
						require_once("../class/DBmanager.php");
						require_once("../class/Manipulator.php");
						require_once("../class/Factory.php");
						require_once("../class/User.php");
						require_once("../class/RetailOrder.php");
						require_once("../class/MassiveOrder.php");
						require_once("../class/Service.php");}
					else{
						echo "Error: One of the files does not esist.";
						exit;}

					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$f = new Factory($d);
					$m = new Manipulator($d);
					$usr = $f->getUser($_SESSION['Email']);
					$usrType = $usr->getUserType();
					$co = $_SESSION['contatore'];

					switch($usrType){
						case "Al minuto":
							$requestDate = date("Y-m-d H:i:s");
							$st = strtotime("".$_POST['dataRitiro']. " ".$_POST['oraRitiro']);

							$deliveryDate = date("Y-m-d H:i:s",$st);
							$r = new RetailOrder($requestDate, "in_lavorazione", $usr, $_POST['decrizioneUtente'], $deliveryDate, NULL);
							for($i=1; $i<=$co; $i++){
								$p = $f->getProduct($_SESSION['listaProdotti'.$i]);
								$y = $_SESSION[$_SESSION['listaProdotti'.$i]];
								for($j=1; $j<=$y; $j++){
									$r->insertProduct($p);
								}
							}
							$b = $m->insertRequest($r);
							if($b==true){
								echo "Successful prenotation!";
							}
							else{
								echo "Something went wrong please try again";
							}
							break;

						case "All_ingrosso":
							$requestDate = date("Y-m-d H:i:s");
							$st = strtotime("".$_POST['dataRitiro']. " ".$_POST['oraRitiro']);

							$deliveryDate = date("Y-m-d H:i:s",$st);
							$r = new MassiveOrder($_POST['indirizzoConsegna'], $_POST['periodicita'], $requestDate, "in_lavorazione", $usr, $deliveryDate, NULL);
							for($i=1; $i<=$co; $i++){
								$p = $f->getProduct($_SESSION['listaProdotti'.$i]);
								$y = $_SESSION[$_SESSION['listaProdotti'.$i]];
								for($j=1; $j<=$y; $j++){
									$r->insertProduct($p);
								}
							}
							$b = $m->insertRequest($r);
							if($b==true){
								echo "<p>Successful prenotation!</p>";
							}
							else{
								echo "Something went wrong please try again";
							}
							break;

						case "Servizio":
							$requestDate = date("Y-m-d H:i:s");
							$st = strtotime("".$_POST['dataRitiro']. " ".$_POST['oraRitiro']);

							$deliveryDate = date("Y-m-d H:i:s",$st);
							$p = $f->getProduct($_POST['listaProdotti']);
							$r = new Service($p, $_POST['personaleRichiesto'], $_POST['risorseNecessarie'], $_POST['indirizzoEvento'], $date, "in_lavorazione", $usr, $deliveryDate, NULL);
							$b = $m->insertRequest($r);
							if($b==true){
								echo "Successful prenotation!";
							}
							else{
								echo "Something went wrong please try again";
							}
							break;
						//}
					}
				}


				if(isset($_POST['prenotazione']) || count($_POST)==0){
					$_SESSION['contatore'] = 0;
					if(file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/Factory.php") && file_exists("../class/User.php") && file_exists("../class/Service.php") && file_exists("../class/RetailOrder.php") && file_exists("../class/MassiveOrder.php")){

						require_once("../class/DBmanager.php");
						require_once("../class/Manipulator.php");
						require_once("../class/Factory.php");
						require_once("../class/User.php");
						require_once("../class/RetailOrder.php");
						require_once("../class/MassiveOrder.php");
						require_once("../class/Service.php");}
					else{
						echo "Error: One of the files does not esist.";
						exit;}

					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$f = new Factory($d);
					$usr = $f->getUser($_SESSION['Email']);

					$usrType = $usr->getUserType();
					$prod = $f->getProductList($usrType);

					echo "<div id='ordineForm'>";
					echo "<form action='' method='POST' >";
					echo "</br>";
					echo "Prodotto:";
					echo "<select name='listaProdotti'  required>";
					echo "<option value=''>--</option>";
					foreach ($prod as $x) {
						echo "<option value='" . $x->getName() . "'>" . $x->getName() . "</option>";
					}
					echo "</select>";
					echo "</br></br>";

					switch($usrType ){
						case "Al minuto":
							echo "Numero prodotti: <input type='number' name='numeroProdotti' required>";
							echo "</br></br>";
							echo "<input type='submit' name='nuovoProd' value='Inserisci il prodottoo nella tua prenotazione'>";
							echo "</br></br>";
							echo "</form>";
							echo "<form action='' method='POST' >";
							echo "Descrizione utente:<textarea name='decrizioneUtente' rows='5' cols='30'>Torta di compleanno con la scrittura Buon compleanno.</textarea></br></br>";
							echo "</br></br>";
							break;

						case "All_ingrosso":
							echo "Numero prodotti: <input type='number' name='numeroProdotti' required>";
							echo "</br></br>";
							echo "<input type='submit' name='nuovoProd' value='Inserisci il prodottoo nella tua prenotazione'>";
							echo "</br></br>";
							echo "</form>";
							echo "<form action='' method='POST' >";
							echo "Indirizzo consegna:<input type='text' name='indirizzoConsegna' required>";
							echo "</br></br>";
							echo "Periodicita: <select name='periodicita' required>";
							echo "</br></br>";
							echo "<option value=''>--</option>";
							echo "<option value='settimanale'>settimanale </option>";
							echo "<option value='mensile'>mensile</option>";
							echo "</select>";
							echo "</br></br>";
							break;

						case "Servizio":
							echo "Personale richiesto: <input type='number' name='personaleRichiesto' required>";
							echo "</br></br>";
							echo "Risorse necessarie: <textarea name='risorseNecessarie' rows='5' cols='30' required> 5 tavole, 20 sedie. </textarea>";
							echo "</br></br>";
							echo "Indirizzo evento: <input type='text' name='indirizzoEvento' required>";
							echo "</br></br>";
							break;
					}
					echo "Data ritiro/consegna/evento:     <input type='text' name='dataRitiro' placeholder='YYYY-MM-DD' required>";
					echo "</br></br>";
					echo "Ora ritiro/consegna/evento(da 0 a 24):     <input type='text' name='oraRitiro' placeholder='HH:MM:SS' required>";
					echo "</br></br>";

					echo "<input type='submit' name='prenota' value='Prenota'>";
					echo "</br></br>";
					echo "</form>";
					echo "</div>";
				}


				if(isset($_POST['nuovoProd'])){
					$c = $_SESSION['contatore'];
					$controllo = 0;
					for($i=1; $i<=$c; $i++){
						if($_SESSION['listaProdotti'.$c] == $_POST['listaProdotti']){
							$controllo=1;
							break;
						}
					}
					if($controllo == 0){
						$_SESSION['contatore'] = $_SESSION['contatore'] + 1;
						$c = $_SESSION['contatore'];
						$_SESSION['listaProdotti'.$c] = $_POST['listaProdotti'];
						$_SESSION[$_POST['listaProdotti']] = $_POST['numeroProdotti'];
					}
					else{
						$_SESSION[$_POST['listaProdotti']] = $_SESSION[$_POST['listaProdotti']] + $_POST['numeroProdotti'];
					}
					if(file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/Factory.php") && file_exists("../class/User.php") && file_exists("../class/Service.php") && file_exists("../class/RetailOrder.php") && file_exists("../class/MassiveOrder.php")){

						require_once("../class/DBmanager.php");
						require_once("../class/Manipulator.php");
						require_once("../class/Factory.php");
						require_once("../class/User.php");
						require_once("../class/RetailOrder.php");
						require_once("../class/MassiveOrder.php");
						require_once("../class/Service.php");}
					else{
						echo "Error: One of the files does not esist.";
						exit;}

					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$f = new Factory($d);
					$usr = $f->getUser($_SESSION['Email']);
					$usrType = $usr->getUserType();

					$prod = $f->getProductList($usrType);
					echo "<div id='ordineForm'>";
					echo "<form action='' method='POST' >";
					echo "<fieldset>";
					echo "<legend>Prenotazione</legend>";
					echo "</br>";
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
					echo "</br></br>";
					echo "Prodotto:";
					echo "<select name='listaProdotti'  required>";
					echo "<option value=''>--</option>";
					foreach ($prod as $x) {
						echo "<option value='" . $x->getName() . "'>" . $x->getName() . "</option>";
					}
					echo "</select>";
					echo "</br></br>";

					switch($usrType ){
						case "Al minuto":
							echo "Numero prodotti: <input type='number' name='numeroProdotti' required>";
							echo "</br></br>";
							echo "<input type='submit' name='nuovoProd' value='Inserisci il prodottoo nella tua prenotazione'>";
							echo "</br></br>";
							echo "</form>";
							echo "<form action='' method='POST' >";
							echo "Descrizione utente:<textarea name='decrizioneUtente' rows='5' cols='30'>Torta di compleanno con la scrittura Buon compleanno.</textarea></br></br>";
							echo "</br></br>";
							break;

						case "All_ingrosso":
							echo "Numero prodotti: <input type='number' name='numeroProdotti' required>";
							echo "</br></br>";
							echo "<input type='submit' name='nuovoProd' value='Inserisci il prodottoo nella tua prenotazione'>";
							echo "</br></br>";
							echo "</form>";
							echo "<form action='' method='POST' >";
							echo "Indirizzo consegna:<input type='text' name='indirizzoConsegna' required>";
							echo "</br></br>";
							echo "Periodicita: <select name='periodicita' required>";
							echo "</br></br>";
							echo "<option value=''>--</option>";
							echo "<option value='settimanale'>settimanale </option>";
							echo "<option value='mensile'>mensile</option>";
							echo "</select>";
							echo "</br></br>";
							break;
					}
					echo "Data ritiro/consegna/evento:     <input type='text' name='dataRitiro' placeholder='YYYY-MM-DD' required>";
					echo "</br></br>";
					echo "Ora ritiro/consegna/evento(da 0 a 24):     <input type='text' name='oraRitiro' placeholder='HH:MM:SS' required>";
					echo "</br></br>";
					echo "<input type='submit' name='prenota' value='Prenota'>";
					echo "</br></br>";
					echo "</form>";
					echo "</div>";
				}
			?>
	</body>
</html>
