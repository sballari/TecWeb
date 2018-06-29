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
				echo "<table>";
				
  				echo "<caption><span class='aiuti'>Nella tabella viene fornito i dettagli del Servizio selezionata. Ogni riga descrive una caratteristica del servizio.
				  In ordine sono numero, nome, descrizione, numero personale richiesto, numero risorse richieste, indirizzo evento, data di ricezione della richiesta,
				  data dell'evento, stato della richiesta</span>Dettagli Servizio numero ".$Richiesta->getKey()." </caption>";
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
  			  echo "<table>";
  			  echo "<caption><span class='aiuti'>Nella tabella viene fornito i dettagli dell&rsquo;ordine selezionato. Ogni riga descrive una caratteristica dell&rsquo;ordine.
				In ordine sono numero, periodicit&agrave;, indirizzo di consegna, ora e data di ricezine, ora e data di consegna e stato.</span>Dettagli ordine all'ingrosso codice ".$Richiesta->getKey()." </caption>";
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
				echo "<table>";
  			  echo "<caption><span class='aiuti'>Nella tabella viene fornito i dettagli dell&rsquo;ordine al minuto selezionato. Ogni riga descrive una caratteristica dell&rsquo;ordine.
  			  In ordine sono chiave, note utente, data e ora di ricezione, data e ora di ritiro, stato.</span>Dettagli ordine all'ingrosso codice ".$Richiesta->getKey()." </caption>";
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
		echo "<table>";
			
  			echo "<caption><span class='aiuti'>Nella tabella viene fornito i dettagli del utente selezionato. Ogni riga descrive una caratteristica dell'utente.</span>Dettagli Utente </caption>";
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
	   echo "<table>";
  		 echo "<caption><span class='aiuti'>Nella tabella viene fornito i dettagli del prodotto selezionato. Ogni riga descrive una caratteristica del prodotto.</span>Dettagli Prodotto </caption>";
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
		   echo "<table aria-label='tabella ordini servizio'>
		   <caption class='aiuti'>Nella tabella viene fornito i dettagli dell&rsquo;ordine effettuato. Ogni riga descrive una caratteristica del prodotto a partire da spunta di selezione, codice, data e ora, stato.</caption>
  		   <tr>
  		   <th scope = 'col' abbr='selezione'>Seleziona</th>
  		   <th scope = 'col' abbr='codice'>Codice</th>
  		   <th scope = 'col' abbr='tempo'>Data e ora di consegna </th>
  		   <th scope = 'col' abbr='stato'>Stato</th>
  		   </tr>";
  		 foreach ($req as $x) {
			   echo "<tr>";
			   echo "<td>".$id."
			   <input id='request". $id ."' type='radio' name='request' value='request" . $id . "' ><label for='request". $id ."' class='aiuti'>Inserisci richiesta</label></td>";//TODO
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
		   echo "<table aria-label='tabella ordini ingrosso'>
		   <caption class='aiuti'>Nella tabella viene fornito i dettagli dell&rsquo;ordine effettuato. Ogni riga descrive una caratteristica del prodotto a partire da spunta di selezione, codice, data e ora, stato.</caption>
  		   <tr>
  		   <th scope = 'col' abbr='selezione'>Seleziona</th>
  		   <th scope = 'col' abbr='codice'>Codice</th>
  		   <th scope = 'col' abbr='tempo'>Data e ora di consegna </th>
  		   <th scope = 'col' abbr='stato'>Stato</th>
  		   </tr>";
  		 foreach ($req as $x) {
  			 echo "<tr>";
  			 echo "<td>".$id."<input id='request". $id ."' type='radio' name='request' value='request" . $id . "'><label for='request". $id ."' class='aiuti'>Inserisci richiesta</label></td>";
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
		 echo "<table aria-label='tabella ordini al minuto'>
		 	<caption class='aiuti'>Nella tabella viene fornito i dettagli dell&rsquo;ordine effettuato. Ogni riga descrive una caratteristica del prodotto a partire da spunta di selezione, codice, data e ora, stato.</caption>
  		   <tr>
  		   <th scope = 'col' abbr='selezione'>Seleziona</th>
  		   <th scope = 'col' abbr='codice'>Codice</th>
  		   <th scope = 'col' abbr='tempo'>Data e ora di consegna </th>
  		   <th scope = 'col' abbr='stato'>Stato</th>
  		   </tr>";
  	   foreach ($req as $x) {
  		   echo "<tr>";
  		   echo "<td>".$id."<input id='request". $id ."' type='radio' name='request' value='request" . $id . "'><label for='request". $id ."' class='aiuti'>Inserisci richiesta</label></td>";
  		   echo "<td>" . $x->getKey() . "</td>";
  		   echo "<td>" . $x->getDeliveryDateTime() . "</td>";
  		   echo "<td>" . $x->getStatus() . "</td>";
  		   echo "</tr>";
  		   $id++;
  	   }
  	   echo "</table>";
     }

  	public function printComposizioneOrdineTable($ordine){
  		echo "<table>";
  		echo "<caption><span class='aiuti'>La tabella indica i prodotti che compongono l&#39;ordine richiesto. Ogni riga rappresenta un prodotto.
		  I dati forniti in ogni riga sono, in ordine, nome del prodotto e quantit&agrave; ordinata.</span>Composizione Ordine</caption>";
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
  	$d = new DBmanager("localhost", "sballari", "Sheishioc1eith6a", "sballari");
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
  	$d = new DBmanager("localhost", "sballari", "Sheishioc1eith6a", "sballari");
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

    $d = new DBmanager("localhost", "sballari", "Sheishioc1eith6a", "sballari");
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
		  echo "<table aria-label='tabella utenti'>
		  		<caption>Scrolla a sinistra e destra per vedere la tabella in larghezza. O ruota il dispositivo se sei col telefono.</caption>
  				<tr>
  				<th scope='col' abbr='selezione' >Seleziona</th>
  				<th scope='col' abbr='email' >Email</th>
  				<th scope='col' abbr='tipo' >Tipo utente</th>
  				</tr>";
  	$id = 1;
  	foreach ($usr as $x) {
  		echo "<tr>";
  		echo "<td>".$id."<input id='request" . $id . "' type='radio' name='utente' value='utente" . $id . "'><label for='request". $id ."' class='aiuti'>Inserisci richiesta</label></td>";
  		echo "<td>" . $x->getEmail() . "</td>";
  		echo "<td>" . $x->getUserType() . "</td>";
  		echo "</tr>";
  		$id++;
  	}
  	echo "</table>";
  	echo "</div>";
  	}
  	echo "<button type='submit' name='cancellaUtente'>Cancella l'utente</button>";
  	echo "<button type='submit' name='utenteDettagliato'>Utente dettagliato</button>";
  	echo "</form>";
  	echo "</div>";
  }


  public function printTabellaProdotti(){

  	$d = new DBmanager("localhost", "sballari", "Sheishioc1eith6a", "sballari");
  	$d->connect();
  	$f = new Factory($d);
  	$prod = $f->getEntireProductList();
  	$d->disconnect();
  	echo "<div id='formOrdini' class='contentElement'>";
  	echo "<form action = '../operationManagers/operationManagerImpiegato.php' method = 'POST'>";
  	
	  echo "<table aria-label='tabella Prodotti'>
	  <caption>Scrolla a sinistra e destra per vedere la tabella in larghezza. O ruota il dispositivo se sei col telefono.</caption>
  			<tr>
  			<th scope='col' abbr='selezione' >Seleziona</th>
  			<th scope='col' abbr='nome' >Nome</th>
  			<th scope='col' abbr='tipo' >Tipo</th>
  			</tr>";
  	$id=1;
  	foreach ($prod as $x) {
  		echo "<tr>";
  		echo "<td>".$id."<input id='prodotto". $id ."' type='radio' name='prodotto' value='prodotto" . $id . "'><label for='prodotto". $id ."' class='aiuti'>Inserisci richiesta</label></td>";
  		echo "<td>" . $x->getName() . "</td>";
  		echo "<td>" . $x->getProductType() . "</td>";
  		echo "</tr>";
  		$id++;
  	}
  	echo "</table>";
  	
  	echo "<button type='submit' name='cancellaProdotto'>Cancella prodotto</button>";
  	
  	echo "<button type='submit' name='prodottoDettagliato'>Prodotto dettagliato</button>";
  	echo "</form>";
  	echo "</div>";
  }

  public function printFormPrenotazione($usrType){
    $d = new DBmanager("localhost", "sballari", "Sheishioc1eith6a", "sballari");
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
  	echo "<select id='listaProdotti' name='listaProdotti'  required>";
  	echo "<option value=''>--</option>";
  	foreach ($prod as $x) {
  		echo "<option value='" . $x->getName() . "'>" . $x->getName() . "</option>";
  	}
	echo "</select>";
	echo "</div>";

    switch($usrType ){
  	   case "Al minuto":

  			 echo "<label for='numeroProdotti'>Numero prodotti:</label>";
  			 echo "<input id='numeroProdotti' type='number' name='numeroProdotti' required>";

  		   echo "<button type='submit' name='nuovoProd'>Inserisci prodotto</button>";
        
         echo "</fieldset>";
  		   echo "</form>";
  		   echo "<form action='../operationManagers/operationManager.php' method='POST' >";
  		   echo "<fieldset>";
  		   echo "<legend>Dati prenotazione</legend>";
  		
  			 echo "<label for='descrizioneUtente'>Descrizione utente:</label>";
  			 echo "<textarea id='descrizioneUtente' name='descrizioneUtente' rows='5' cols='30'>Dolce con la scritta Buon compleanno.</textarea>";
  		
  		   break;

  	   case "All_ingrosso":
  		   echo "<label for='numeroProdotti'>Numero prodotti:</label><input id='numeroProdotti' type='number' name='numeroProdotti' required>";
  		   echo "<button type='submit' name='nuovoProd'>Inserisci prodotto</button>";
  		
  		   echo "</fieldset>";
  		   echo "</form>";
  		   echo "<form action='../operationManagers/operationManager.php' method='POST' >";
  		   echo "<fieldset>";
  		   echo "<legend>Dati prenotazione</legend>";
  		
  		   echo "<label for ='indirizzoConsegna'>Indirizzo consegna:</label><input id='indirizzoConsegna' type='text' name='indirizzoConsegna' required>";
  		
  		   echo "<label for='periodicita'>Periodicita:</label><select id='periodicita' name='periodicita' required>";
         echo "<option value=''>--</option>";
  		   echo "<option value='settimanale'>settimanale </option>";
  		   echo "<option value='mensile'>mensile</option>";
  	   	 echo "</select>";
  		
  		   break;

  	   case "Servizio":
  		   echo "<label for='personaleRichiesto'>Personale richiesto:</label><input id='personaleRichiesto' type='number' name='personaleRichiesto' required>";
  		
  		   echo "<label for='risorseNecessarie'>Risorse necessarie:</label><textarea id='risorseNecessarie' name='risorseNecessarie' rows='5' cols='30' required> 5 tavole, 20 sedie. </textarea>";
  		
  		   echo "<label for='indirizzoEvento'>Indirizzo evento:</label><input id='indirizzoEvento' type='text' name='indirizzoEvento' required>";
  		
  		   break;
    }

    echo "<label for='dataRitiro'>Data ritiro/consegna/evento:</label><input id='dataRitiro' type='date' name='dataRitiro' required>";

    echo "<label for='oraRitiro'>Ora ritiro/consegna/evento</label><input id='oraRitiro' type='time' name='oraRitiro' required>";

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
  			<th scope='col' abbr='numero' >Nr.</th>
  			<th scope='col' abbr='nome' >Nome</th>
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
