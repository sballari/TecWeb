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
  require_once("CommonHtmlElement.php");
  class ElementDisplayer{

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


     public function printUtenteDettagliatoDiv($utente){

  	    echo "<div class='contentElement'>";
        echo "<table summary='Nella tabella viene fornito i dettagli del utente selezionato. Ogni riga descrive una caratteristica dell'utente.";
  			echo "<caption>Dettagli Utente </caption>";
  			echo "<tr>
  						<th scope = 'row' abbr='nome'>Nome utente</th>
  						<td>".$utente->getName()."</td>
  					  </tr>";
  			echo "<tr>
  					<th scope = 'row' abbr='cognome'>Cognome utente</th>
  					<td>".$utente->getSurname()."</td>
  				  </tr>";
  			echo "<tr>
  					<th scope = 'row' abbr='tipo'>Tipo utente</th>
  					<td>".$utente->getUserType()."</td>
  				  </tr>";
  			echo "<tr>
  					<th scope = 'row' abbr='email'>Email utente</th>
  					<td>".$utente->getEmail()."</td>
  				  </tr>";
  			echo "<tr>
  					<th scope = 'row' abbr='password'>Password utente</th>
  					<td>".$utente->getPassword()."</td>
  				  </tr>";

  		 echo "</table>";

       echo "</div>";
     }



     public function printProdottoDettagliatoDiv($prodotto){
       echo "<div class='contentElement'>";
       echo "<table summary='Nella tabella viene fornito i dettagli del prodotto selezionato. Ogni riga descrive una caratteristica del prodotto.";
  		 echo "<caption>Dettagli Prodotto </caption>";
  		 echo "<tr>
  						<th scope = 'row' abbr='nome'>Nome</th>
  						<td>".$prodotto->getName()."</td>
  					  </tr>";
       echo "<tr>
  					<th scope = 'row' abbr='tipo'>Tipo prodotto</th>
  					<td>".$prodotto->getProductType()."</td>
  				  </tr>";
  		 echo "<tr>
  					<th scope = 'row' abbr='ingridienti'>Ingridienti</th>
  					<td>".$prodotto->getIngredients()."</td>
  				  </tr>";
  		 echo "<tr>
  					<th scope = 'row' abbr='descrizione'>Descrizione</th>
  					<td>".$prodotto->getDesc()."</td>
  				  </tr>";
  		  echo "<tr>
  				 <th scope = 'row' abbr='image'>Image path</th>
  				 <td>".$prodotto->getImage()."</td>
  			   </tr>";
       echo "</table>";
       echo "</div>";
     }



     public function printStoriaOrdiniServizio($req){
       $id=1;
  		 echo "<p>Tabella degli ordini servizio</p>";
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
  		 if(isset($_SESSION['operazione']) && $_SESSION['operazione'] == "ordini"){
  		   $_SESSION['iD'] = $id;
       }
  		 echo "</table>";
     }

     public function printStoriaOrdiniAllIngrosso($req){
  		 if(isset($_SESSION['iD'])){
  			 $id = $_SESSION['iD'];
  		 }
  		 else{
  			 $id=1;
  		 }
  		 echo "<p>Tabella degli ordini all'ingrosso</p>";
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
  		 if(isset($_SESSION['operazione']) && $_SESSION['operazione'] == "ordini"){
  		   $_SESSION['iD'] = $id;
  	   }
  		 echo "</table>";
     }

     public function printStoriaOrdiniAlMinuto($req){
  	   if(isset($_SESSION['iD'])){
  		   $id = $_SESSION['iD'];
  	   }
  	   else{
  		   $id=1;
  	   }
  	   echo "<p>Tabella degli ordini al minuto</p>";
  	   echo "<table>
  		   <tr>
  		   <th>Seleziona</th>
  		   <th>Codice </th>
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

  	echo "<div class='contentElement'>";
  	echo "<form action = '../operationManagers/operationManager.php' method = 'POST'>";
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
    if(isset($_SESSION['operazione'])){
      unset($_SESSION['operazione']);
    }
  	$d->disconnect();
  }


  public function printTabellaOrdini(){
  	$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
  	$d->connect();
  	$f = new Factory($d);

  	echo "<div class='contentElement'>";
  	echo "<form action = '../operationManagers/operationManagerImpiegato.php' method = 'POST'>";

  	$req = $f->getTypeRequestList("Servizio");
  	$this->printStoriaOrdiniServizio($req);

  	$req = $f->getTypeRequestList("All_ingrosso");
  	$this->printStoriaOrdiniAllIngrosso($req);

  	$req = $f->getTypeRequestList("Al minuto");
  	$this->printStoriaOrdiniAlMinuto($req);
  	if(isset($_SESSION['iD'])){
  		unset($_SESSION['iD']);
  	}
  	if(isset($_SESSION['operazione'])){
  		unset($_SESSION['operazione']);
  	}
  	echo "<button type='submit' name='cambiaStato' >Cambia stato</button>";
  	echo "<button type='submit' name='cancellaRichiesta' >Cancella la richiesta</button>";
  	echo "<button type='submit' name='richiestaDettagliataImp' >Richiesta dettagliata</button>";
  	echo "</form>";
  	echo "</div>";
  	$d->disconnect();
  }


  public function printTabellaUtenti(){

    $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
  	$d->connect();
  	$f = new Factory($d);
  	$usr = $f->getEntireUserList();
  	$d->disconnect();
  	echo "<div class='contentElement'>";
  	echo "<form action = '../operationManagers/operationManagerImpiegato.php' method = 'POST'>";
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
  		echo "<td>".$id."<input type='radio' name='utente' value='utente" . $id . "' ></td>";
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


  public function printTabellaProdotti(){

  	$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
  	$d->connect();
  	$f = new Factory($d);
  	$prod = $f->getEntireProductList();
  	$d->disconnect();
  	echo "<div id='formOrdini' class='contentElement'>";
  	echo "<form action = '../operationManagers/operationManagerImpiegato.php' method = 'POST'>";
  	echo "</br></br>";
  	echo "<table>
  			<tr>
  			<th>Seleziona</th>
  			<th>Nome</th>
  			<th>Tipo</th>
  			</tr>";
  	$id=1;
  	foreach ($prod as $x) {
  		echo "<tr>";
  		echo "<td>".$id."<input type='radio' name='prodotto' value='prodotto" . $id . "' ></td>";
  		echo "<td>" . $x->getName() . "</td>";
  		echo "<td>" . $x->getProductType() . "</td>";
  		echo "</tr>";
  		$id++;
  	}
  	echo "</table>";
  	echo "</br></br>";
  	echo "<button type='submit' name='cancellaProdotto'>Cancella prodotto</button></br>";
  	echo "</br></br>";
  	echo "<button type='submit' name='prodottoDettagliato'>Prodotto dettagliato</button>";
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
    echo "<form action='../operationManagers/operationManager.php' method='POST' >";
    echo "<fieldset>";
    if($usrType!=="Servizio"){
  	   echo "<legend>Lista prodotti</legend>";
    }
    else{
  	   echo "<legend>Dati prenotazione</legend>";
    }
    echo "<div>";
  	echo "<label for='listaProdotti'>Prodotto:</label>  ";
  	echo "<select name='listaProdotti'  required>";
  	echo "<option value=''>--</option>";
  	foreach ($prod as $x) {
  		echo "<option value='" . $x->getName() . "'>" . $x->getName() . "</option>";
  	}
    echo "</div>";
    echo "</select>";
    echo "</br>";

    switch($usrType ){
  	   case "Al minuto":

  			 echo "<label for='numeroProdotti'>Numero prodotti:</label>";
  			 echo "<input type='number' name='numeroProdotti' required>";

  		   echo "<button type='submit' name='nuovoProd'>Inserisci prodotto</button>";
         echo "</br>";
         echo "</fieldset>";
  		   echo "</form>";
  		   echo "<form action='../operationManagers/operationManager.php' method='POST' >";
  		   echo "<fieldset>";
  		   echo "<legend>Dati prenotazione</legend>";
  		   echo "</br>";
  			 echo "<label for='decrizioneUtente'>Descrizione utente:</label>";
  			 echo "<textarea name='decrizioneUtente' rows='5' cols='30'>Dolce con la scritta Buon compleanno.</textarea>";
  		   echo "</br>";
  		   break;

  	   case "All_ingrosso":
  		   echo "<label for='numeroProdotti'>Numero prodotti:</label><input type='number' name='numeroProdotti' required>";
  		   echo "<button type='submit' name='nuovoProd'>Inserisci prodotto</button>";
  		   echo "</br>";
  		   echo "</fieldset>";
  		   echo "</form>";
  		   echo "<form action='../operationManagers/operationManager.php' method='POST' >";
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
    echo "</br>";
    echo "<label for='dataRitiro'>Data ritiro/consegna/evento:</label><input type='date' name='dataRitiro' required>";
    echo "</br>";
    echo "<label for='oraRitiro'>Ora ritiro/consegna/evento x:</label><input type='time' name='oraRitiro' required>";
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
    $h = new CommonHtmlElement();
  	switch($operazione){
  		case "prenotazione":
  			if(isset($_SESSION['submitPremuto']) && $_SESSION['submitPremuto'] == "nuovoProd"){
  				$this->printTabelaProdottiScelti($usrType);
  			}
  			$this->printFormPrenotazione($usrType);
  			break;
  		case "storia":
  			$this->printStoriaOrdini($usrType);
  			break;
  		case "prodotti":
  			$h->printListaProdotti($usrType);
  			break;
  	}
  }




  public function printOperationElementImpiegato($operazione){
  	switch($operazione){
  		case "ordini":
  			$this->printTabellaOrdini();
  			break;
  		case "utenti":
  			$this->printTabellaUtenti();
  			break;
  		case "prodotti":
  			$this->printTabellaProdotti();
  			break;
  	}
  }

  }
  ?>
