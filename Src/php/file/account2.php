<!DOCTYPE HTML>
<html lang ="it">
<?php
      session_start();
      require_once ("CommonHtmlElement.php");
      require_once ("../class/Factory.php");
      require_once ("../class/DBmanager.php");
      require_once ("../class/User.php");
      require_once ("../class/Product.php");
      $h = new CommonHtmlElement();
      $h->printHead("home", "home della pasticceria i tesori di squitty", "home");
      $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
      $d->connect();
      $f = new Factory($d);

 ?>
<body>
    <div id="accessBar">
    </div>
    <?php
          $h->createheader("account");
          $h->printInternalMenu("account");
     ?>
     <div id="content">



		 <?php
     if (!isset($_SESSION) | $_SESSION['Email']=="") {
       echo "<div class='contentElement'>";
       echo "<h3>ERRORE</h3>";
       echo "<p>Non sei autenticato presso il nostro sistema! Procedere alla creazione di un account o all'accesso.</p>";
       echo "</div>";
     }
     else {
        $u = $f->getUser($_SESSION['Email']);
        $t = $u->getUserType();
        echo "<div id='info' class='contentElement'>";
				echo "<h3>INFO</h3>";
        echo "<p>Bentornato " . $_SESSION['Email'].", utente di tipo : ".$t."</p>";
        echo "</div>";
      }

			if(isset($_POST['prodotti'])){
					$prod = $f->getProductList($t);
					foreach ($prod as $x) {
            $h->createProductDiv($x);
					}
			}


			if(isset($_POST['storia'])){

					require_once("../class/Request.php");
					require_once("../class/RetailOrder.php");
					require_once("../class/MassiveOrder.php");
					require_once("../class/Service.php");

					$req = $f->getRequestList($_SESSION['Email']);


					echo "<div class='contentElement'>";
					echo "<form action = '' method = 'POST'>";
					switch($t){
						case "Servizio":
              $h->printStoriaOrdiniServizio($req);
						break;

						case "All_ingrosso":
              $h->printStoriaOrdiniAllIngrosso($req);
						break;

						case "Al minuto":
							$h->printStoriaOrdiniAlMinuto($req);
							break;
					}

					echo "<p>Ricordati che una richiesta deve essere anullata almeno un giorno prima del suo ritiro.</p>";
					echo "<button type='submit' name='annullaRichiesta' >Annulla la richiesta</button>";
					echo "</form>";
				}


		  if(isset($_POST['annullaRichiesta'])){

					require_once("../class/Request.php");
					require_once("../class/RetailOrder.php");
					require_once("../class/MassiveOrder.php");
					require_once("../class/Service.php");

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
									echo "Qualcosa &egrave; andato storto!";
								}
								else{
									echo "La richiesta &egrave stata rimossa.";
								}
							}
							else{
								echo "Non &egrave; possibile rimuovere la richiesta.";
							}
						}
						$id++;
					}

				}



			if(isset($_POST['closeaccount'])){
            echo "<div class = 'contentElement'>";
            echo "<p>Sei sicuro di voler eliminare il tuo account <strong>definitivamente</strong>?</p>";
            echo "</div>";

						$b = $m->removeUser($_SESSION['Email']);
						$diss=$d->disconnect();
						$_SESSION['Email'] = "";

						if($b==false){

							echo "<p>Qualcosa &egrave; andato storto.</p>";
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

						require_once("../class/RetailOrder.php");
						require_once("../class/MassiveOrder.php");
						require_once("../class/Service.php");

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
          unset($_POST);//TEST messo da simone non sono sicuro
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
    </div>

  </body>
</html>
