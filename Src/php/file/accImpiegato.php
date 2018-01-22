<!DOCTYPE HTML>
<html lang ="it">
<head>
    <title> Account Impiegato- I tesori di <span lang="en">Squitty</span> </title>
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
			<h4>Based on what your operation is related to select one of the following buttons.</h4>
			
			<form action = "" method = "POST">
					
					<input type="submit" name="ordini" value="Ordini">
					<input type="submit" name="utente" value="Utente">
					<input type="submit" name="prodotti" value="Prodotti">
					
			</form>
	</div>		
			<?php
			session_start();
			if(isset($_POST['ordini']))
			{
				echo "provaOrdini";
				echo "<div id='formOrdini'>";
				echo "<form action = '' method = 'POST'>";
				//echo "Data ritiro";
				//echo "<input type='text' name='dataOrdine' placeholder='YYYY-MM-DD' ></br></br>";
				//echo "Ora ritiro";
				//echo "<input type='text' name='oraOrdine' placeholder='HH:MM:SS' required></br></br>";
				echo "<input type='checkbox' name='Al_minuto' value='Al minuto' checked>Al minuto</br>";
				echo "<input type='checkbox' name='All_ingrosso' value='All_ingrosso' checked>All'ingrosso</br>";
				echo "<input type='checkbox' name='Servizio' value='Servizio' checked>Servizio</br></br>";
				echo "<input type='submit' name='visualizzaOrdini' value='Visualizza Ordini'></br></br>";
				echo "</form>";
				echo "</div>";
			}	
			
				if(isset($_POST['visualizzaOrdini']))
				{ echo "Again";
					if(file_exists("../class/DBmanager.php")){
					
					require_once("../class/DBmanager.php");
					}
				else{
					echo "Error: One of the files does not esist.";
					exit;}
					
				
				$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
				$d->connect();
				
				
				
					$id=0;
					echo "Try again";
					echo "<form action = '' method = 'POST'>";
					echo "<div id='tabelleOrdini'>";
					
					if(isset($_POST['Al_minuto'])){
						echo "<table>
							<tr>
							<th>Seleziona</th>
							<th>Codice </th>
							<th>Data effettuazione</th>
							<th>Stato</th>
							<th>Data ora ritiro</th>
							
							<th>Descrizione utente</th>
							<th>Utente</th>
							<th>Prodotto</th>
							<th>Numero prodotti</th>
							</tr>";
						$result = $d->submitQuery("SELECT * FROM prenotazione JOIN composizione_al_minuto ON prenotazione.codice =  composizione_al_minuto.prenotazione ");
						//WHERE data_ora_ritiro = '" . $_POST['dataOrdine'] . "'
						if($result==false){
							echo "LAst";
						}
						
						
						while ($arr = $result->fetch_assoc()){
							$id++;
							echo "<tr>";
							echo "<td>".$id."<input type='checkbox' name='request" . $id . "' value='request" . $id . "' >";
							echo "<td>" . $arr['codice'] . "</td>";
							
							echo "<td>" . $arr['data_effettuazione']  . "</td>";
							echo "<td>" . $arr['stato_ordine']  . "</td>";
							echo "<td>" . $arr['data_ora_ritiro'] . "</td>";
							echo "<td>" . $arr['descrizione_utente'] . "</td>";
							echo "<td>" . $arr['utente'] . "</td>";
							echo "<td>" . $arr['prodotto'] . "</td>";
							echo "<td>" . $arr['nr_prodotti'] . "</td>";
							echo "</tr>";
							
							
						}
						echo "</table></br></br></br>";
				
					}
					
					
					if(isset($_POST['All_ingrosso'])){
						echo "<table>
							<tr>
							<th>Seleziona</th>
							<th>Codice </th>
							<th>Data effettuazione</th>
							<th>Stato</th>
							<th>Data ora ritiro</th>
							
							<th>Indirizzo consegna</th>
							<th>Periodicita</th>
							<th>Utente</th>
							<th>Prodotto</th>
							<th>Numero prodotti</th>
							</tr>";
						$result = $d->submitQuery("SELECT * FROM ordine_all_ingrosso JOIN composizione_all_ingrosso ON ordine_all_ingrosso.codice =  composizione_all_ingrosso.ordine_all_ingrosso ");
						//WHERE data_ora_consegna = '" . $_POST['dataOrdine'] . "'
						if($result==false){
							echo "LAst";
						}
						
					
						while ($arr = $result->fetch_assoc()){
							$id++;
							
							echo "<tr>";
							echo "<td>".$id."<input type='checkbox' name='request" . $id . "' value='request" . $id . "' >";
							echo "<td>" . $arr['codice'] . "</td>";
							echo "<td>" . $arr['data_effettuazione']  . "</td>";
							echo "<td>" . $arr['stato_ordine']  . "</td>";
							echo "<td>" . $arr['data_ora_consegna'] . "</td>";
							echo "<td>" . $arr['indirizzo_consegna'] . "</td>";
							echo "<td>" . $arr['periodicita'] . "</td>";
							echo "<td>" . $arr['utente'] . "</td>";
							echo "<td>" . $arr['prodotto'] . "</td>";
							echo "<td>" . $arr['nr_prodotti'] . "</td>";
							
							echo "</tr>";
						}
						echo "</table></br></br></br>";
				
					}
					
					
					if(isset($_POST['Servizio'])){
						echo "<table>
							<tr>
							<th>Seleziona</th>
							<th>Codice </th>
							<th>Data effettuazione</th>
							<th>Stato</th>
							<th>Data ora evento</th>
							
							<th>Risorse necessarie</th>
							<th>Personale richiesto</th>
							<th>Indirizzo evento</th>
							<th>Utente</th>
							<th>Prodotto servizio</th>
							</tr>";
						$result = $d->submitQuery("SELECT * FROM richiesta_servizio ");
						
						//WHERE data_ora_evento = '" . $_POST['dataOrdine'] . "'
						if($result==false){
							echo "LAst";
						}
						
						
					
						while ($arr = $result->fetch_assoc()){
							$id++;
							echo "<tr>";
							echo "<td>".$id."<input type='checkbox' name='request" . $id . "' value='request" . $id . "' >";
							echo "<td>" . $arr['codice'] . "</td>";
							echo "<td>" . $arr['data_effettuazione']  . "</td>";
							echo "<td>" . $arr['stato_ordine']  . "</td>";
							echo "<td>" . $arr['data_ora_evento'] . "</td>";
							echo "<td>" . $arr['risorse_necessarie'] . "</td>";
							echo "<td>" . $arr['personale_richiesto'] . "</td>";
							echo "<td>" . $arr['indirizzo_evento'] . "</td>";
							echo "<td>" . $arr['utente'] . "</td>";
							echo "<td>" . $arr['Prodotto_servizio'] . "</td>";
						
							echo "</tr>";
						}
						echo "</table>";
				
					}
					
					echo "</div>";
					echo "<input type='submit' name='cancellaR' value='Cancella'></br></br>";
					echo "<input type='submit' name='cambiaStato' value='Cambia Stato'></br>";
					echo "</form>";
				}		
			
			
			
			if(isset($_POST['cancellaR'])){
				echo "Test";
					if(file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php")){
						
						require_once("../class/DBmanager.php");
						require_once("../class/Manipulator.php");}
					else{
						echo "Error: One of the files does not esist.";
						exit;}
					
					$id = 0;
					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$m = new Manipulator($d);
					
					$id=0;
					$result1 = $d->submitQuery("SELECT * FROM prenotazione JOIN composizione_al_minuto ON prenotazione.codice =  composizione_al_minuto.prenotazione ");
						//WHERE data_ora_ritiro = '" . $_POST['dataOrdine'] . "'
						while ($arr = $result1->fetch_assoc()){
							$id++;
					echo "TestR";
						$st="request" . $id . "";
						if(isset($_POST[$st])){
								
							echo "try requestremoval";
							
							$b = $m->removeRequest($arr['codice'], "Al minuto");	//****** REMOVERequest NON FUNZIONA l'utente non viene rimosso dal DB******
							echo "var" . $b;
							if($b==false){
								
								echo "Something went at removeRequest wrong try again!";
							}
							
						}
							
						}
					$result2 = $d->submitQuery("SELECT * FROM ordine_all_ingrosso JOIN composizione_all_ingrosso ON ordine_all_ingrosso.codice =  composizione_all_ingrosso.ordine_all_ingrosso ");
						//WHERE data_ora_consegna = '" . $_POST['dataOrdine'] . "'
						while ($arr = $result2->fetch_assoc()){
							$id++;
						echo "TestR";
						$st="request" . $id . "";
						if(isset($_POST[$st])){
								
							echo "try requestremoval";
							
							$b = $m->removeRequest($arr['codice'], "Al minuto");	//****** REMOVERequest NON FUNZIONA l'utente non viene rimosso dal DB******
							echo "var" . $b;
							if($b==false){
								
								echo "Something went at removeRequest wrong try again!";
							}
							
						}
							
						}
					$result3 = $d->submitQuery("SELECT * FROM richiesta_servizio ");
						
						//WHERE data_ora_evento = '" . $_POST['dataOrdine'] . "'

						while ($arr = $result3->fetch_assoc()){
							$id++;
						echo "TestR";
						$st="request" . $id . "";
						if(isset($_POST[$st])){
								
							echo "try requestremoval";
							
							$b = $m->removeRequest($arr['codice'], "Al minuto");	//****** REMOVERequest NON FUNZIONA l'utente non viene rimosso dal DB******
							echo "var" . $b;
							if($b==false){
								
								echo "Something went at removeRequest wrong try again!";
							}
							
						}
							
						}
					
					
				}
				
				
				
				if(isset($_POST['cambiaStato'])){
				echo "Test";
					if(file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php")){
						
						require_once("../class/DBmanager.php");
						require_once("../class/Manipulator.php");}
					else{
						echo "Error: One of the files does not esist.";
						exit;}
					
					$id = 0;
					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$m = new Manipulator($d);
					
					$id=0;
					$result1 = $d->submitQuery("SELECT * FROM prenotazione JOIN composizione_al_minuto ON prenotazione.codice =  composizione_al_minuto.prenotazione ");
						//WHERE data_ora_ritiro = '" . $_POST['dataOrdine'] . "'
						while ($arr = $result1->fetch_assoc()){
							$id++;
					echo "TestR";
						$st="request" . $id . "";
						if(isset($_POST[$st])){
								
							echo "try cambiaStato";
							
							$b = $d->submitQuery("UPDATE prenotazione SET stato_ordine = 'passato' WHERE codice = " . $arr['codice'] . "");	
							echo "var" . $b;
							if($b==false){
								
								echo "Something went at cccc wrong try again!";
							}
							
						}
							
						}
					$result2 = $d->submitQuery("SELECT * FROM ordine_all_ingrosso JOIN composizione_all_ingrosso ON ordine_all_ingrosso.codice =  composizione_all_ingrosso.ordine_all_ingrosso ");
						//WHERE data_ora_consegna = '" . $_POST['dataOrdine'] . "'
						while ($arr = $result2->fetch_assoc()){
							$id++;
						echo "TestR";
						$st="request" . $id . "";
						if(isset($_POST[$st])){
								
							echo "try cambiaStato";
							
							$b = $d->submitQuery("UPDATE ordine_all_ingrosso SET stato_ordine = 'passato' WHERE codice = " . $arr['codice'] . "");		//****** REMOVERequest NON FUNZIONA l'utente non viene rimosso dal DB******
							echo "var" . $b;
							if($b==false){
								
								echo "Something went at removeRequest wrong try again!";
							}
							
						}
							
						}
					$result3 = $d->submitQuery("SELECT * FROM richiesta_servizio ");
						
						//WHERE data_ora_evento = '" . $_POST['dataOrdine'] . "'

						while ($arr = $result3->fetch_assoc()){
							$id++;
						echo "TestR";
						$st="request" . $id . "";
						if(isset($_POST[$st])){
								
							echo "try cambiaStato";
							
							$b = $d->submitQuery("UPDATE richiesta_servizio SET stato_ordine = 'passato' WHERE codice = " . $arr['codice'] . "");	//****** REMOVERequest NON FUNZIONA l'utente non viene rimosso dal DB******
							echo "var" . $b;
							if($b==false){
								
								echo "Something went at removeRequest wrong try again!";
							}
							
						}
							
						}
					
					
				}
			
			
			if(isset($_POST['utente'])){
				echo "provaUtente";
			
				if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php")){
					require_once("../class/Factory.php");
					require_once("../class/DBmanager.php");
					require_once("../class/Manipulator.php");}
				else{
					echo "Error: One of the files does not esist.";
					exit;}
					
				
				$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
				$d->connect();
				$f = new Factory($d);
				$usr = $f->getUserList();
        
				echo "<form action = '' method = 'POST'>";
				if($usr==false){
					echo "Something went wrong! Try again.";
				}
				else{
					echo "<div id='tabelaUtenti'>";
					echo "<table>
							<tr>
							<th>Seleziona</th>
							<th>Nome utente</th>
							<th>Cognome utente</th>
							<th>Email utente</th>
							<th>Password utente</th>
							
							<th>Tipo utente</th>
							</tr>";
				$id = 0;
				foreach ($usr as $x) {
					$id++;
					echo "<tr>";
					echo "<td>".$id."<input type='checkbox' name='utente" . $id . "' value='utente" . $id . "' >";
					echo "<td>" . $x->getName() . "</td>";
					echo "<td>" . $x->getSurname() . "</td>";
					echo "<td>" . $x->getEmail() . "</td>";
					echo "<td>" . $x->getPassword() . "</td>";
					echo "<td>" . $x->getUserType() . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</div>";
				}
				echo "</br>";
				echo "</br>";
				
				echo "<input type='submit' name='cancella' value='Cancella'></br>";
				echo "</form>";
			}
				if(isset($_POST['cancella'])){
					if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php")){
						require_once("../class/Factory.php");
						require_once("../class/DBmanager.php");
						require_once("../class/Manipulator.php");}
					else{
						echo "Error: One of the files does not esist.";
						exit;}
					
				
					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$m = new Manipulator($d);
					$f = new Factory($d);
					$usr = $f->getUserList();
					
					$id = 0;
					foreach ($usr as $x) {
					$id++;
						$st="utente" . $id . "";
						if(isset($_POST[$st])){
								
							echo "try";
							$e = $x->getEmail();
							echo "var" . $e;
							$b = $m->removeUser($e);	//****** REMOVEUSER NON FUNZIONA l'utente non viene rimosso dal DB******
							echo "var" . $b;
							if($b==false){
								
								echo "Something went at removeUser wrong try again!";
							}
							
						}
						
					}
					
				}
			
			
			
			
			
			
			
			
			
			if(isset($_POST['prodotti']))
			{
				echo "provaProdotti";
				echo "<div id='formOrdini'>";
				echo "<form action = '' method = 'POST'>";
				
				echo "<input type='submit' name='aggiuntaProdotto' value='Aggiungi un nuovo prodotto' ></br>";
				
				if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php")){
					require_once("../class/Factory.php");
					require_once("../class/DBmanager.php");}
				else{
					echo "Error: One of the files does not esist.";
					exit;}

				$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
				$d->connect();
				$f = new Factory($d);
				$prod1 = $f->getProductList("Al minuto");
        //echo var_dump($prod);
				$id=0;
				
				echo "<table>
							<tr>
							<th>Seleziona</th>
							<th>Nome</th>
							<th>Percorso imagine</th>
							<th>Ingredienti</th>
							<th>Descrizione</th>
							</tr>";
				foreach ($prod1 as $x) {
					
					$id++;
					echo "<tr>";
					echo "<td>".$id."<input type='checkbox' name='prodotto" . $id . "' value='prodotto" . $id . "' >";
					echo "<td>" . $x->getName() . "</td>";
					echo "<td>" . $x->getImage()  . "</td>";
					echo "<td>" . $x->getIngredients()  . "</td>";
					echo "<td>" . $x->getDesc() . "</td>";
					echo "</tr>";
				}
				
				
				
				
				$prod2 = $f->getProductList("All_ingrosso");
				
				foreach ($prod2 as $x) {
					
					$id++;	
					echo "<tr>";
					echo "<td>".$id."<input type='checkbox' name='prodotto" . $id . "' value='prodotto" . $id . "' >";
					echo "<td>" . $x->getName() . "</td>";
					echo "<td>" . $x->getImage()  . "</td>";
					echo "<td>" . $x->getIngredients()  . "</td>";
					echo "<td>" . $x->getDesc() . "</td>";
					echo "</tr>";
				}
				
				
				
				$prod3 = $f->getProductList("Servizio");
				
				foreach ($prod3 as $x) {
					
					$id++;	
					echo "<tr>";
					echo "<td>".$id."<input type='checkbox' name='prodotto" . $id . "' value='prodotto" . $id . "' >";
					echo "<td>" . $x->getName() . "</td>";
					echo "<td>" . $x->getImage()  . "</td>";
					echo "<td>" . $x->getIngredients()  . "</td>";
					echo "<td>" . $x->getDesc() . "</td>";
					echo "</tr>";
				}
				echo "</table>";
							
						
				echo "<input type='submit' name='cancellaProdotto' value='Cancella prodotto' ></br>";
				echo "Per modificare prodotti devi scegliere i prodotti uno alla volta.";
				echo "<input type='submit' name='modificaProdotto' value='Modifica prodotto'></br></br>";
				
				echo "</form>";
				echo "</div>";
			}	
			
			
			if(isset($_POST['aggiuntaProdotto'])){
				
				echo "provaAggiuntaProdotti";
				echo "<div id='formAggiuntaProdotti'>";
				echo "<form action = '' method = 'POST'>";
				echo "Nome prodotto";
				echo "<input type='text' name='nomeProdotto' placeholder='nome' required ></br></br>";
				echo "Tipo prodotto";
				echo "<select name='tipoProdotto' required>";
				echo "<option value='Al minuto'>Al minuto</option>";
				echo "<option value='All_ingrosso'>All_ingrosso</option>";
				echo "<option value='Servizio'>Servizio</option>";
				echo "</select></br></br>";
				echo "Ingredienti ";
				echo "<textarea name='ingidientiProdotto' rows='2' cols='100' required>Inserisci ingridienti</textarea></br></br>";
				echo "Descrizione";
				echo "<textarea name='descrizioneProdotto' rows='5' cols='100' required>Inserisci descrizione</textarea></br></br>";
				echo "Percorso imagine prodotto";
				echo "<input type='text' name='percorsoImagineProdotto' placeholder='Inserisci il path del imagine' required ></br></br>";
				echo "<input type='submit' name='inserisciProdotto' value='Inserisci Prodotto'></br>";
				echo "</form>";
				echo "</div>";
				
			}	
				if(isset($_POST['inserisciProdotto'])){
					if(isset($_POST['nomeProdotto']) && isset($_POST['tipoProdotto']) && isset($_POST['ingidientiProdotto']) && isset($_POST['descrizioneProdotto']) && isset($_POST['percorsoImagineProdotto'])){
					
						if(file_exists("../class/Manipulator.php") && file_exists("../class/DBmanager.php") && file_exists("../class/Product.php")){
							require_once("../class/Manipulator.php");
							require_once("../class/DBmanager.php");
							require_once("../class/Product.php");}
						else{
							echo "Error: One of the files does not esist.";
							exit;}
					
				
						$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
						$d->connect();
						$m = new Manipulator($d);
						echo "kot" . $_POST['percorsoImagineProdotto'];
						$p = new Product($_POST['percorsoImagineProdotto'], $_POST['descrizioneProdotto'], $_POST['ingidientiProdotto'], $_POST['tipoProdotto'], $_POST['nomeProdotto']);
						$b = $m->insertProduct($p);
						if($b==false){
							echo "Error! Try again!";
						}
					}
				}
			
			
			
			if(isset($_POST['cancellaProdotto'])){
					if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php")){
						require_once("../class/Factory.php");
						require_once("../class/DBmanager.php");
						require_once("../class/Manipulator.php");}
					else{
						echo "Error: One of the files does not esist.";
						exit;}
					
				
					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$m = new Manipulator($d);
					$f = new Factory($d);
					
					$prod1 = $f->getProductList("Al minuto");
        
				$id=0;
				
				
				foreach ($prod1 as $x) {
					
					$id++;
					$st="prodotto" . $id . "";
						if(isset($_POST[$st])){
								
							echo "try remove product";
							
							$b = $m->removeProduct($x->getName());	
							echo "var" . $b;
							if($b==false){
								
								echo "Something went at removeProduct wrong try again!";
							}
							
						}
					
				}
				
				
				
				
				$prod2 = $f->getProductList("All_ingrosso");
				
				foreach ($prod2 as $x) {
					$id++;	
					$st="prodotto" . $id . "";
						if(isset($_POST[$st])){
								
							echo "try remove product";
							
							$b = $m->removeProduct($x->getName());	
							echo "var" . $b;
							if($b==false){
								
								echo "Something went at removeProduct wrong try again!";
							}
							
						}
					
				}
				
				
				
				$prod3 = $f->getProductList("Servizio");
				
				foreach ($prod3 as $x) {
					
					$id++;
					$st="prodotto" . $id . "";
						if(isset($_POST[$st])){
								
							echo "try remove product";
							
							$b = $m->removeProduct($x->getName());	
							echo "var" . $b;
							if($b==false){
								
								echo "Something went at removeProduct wrong try again!";
							}
							
						}
					
				}
					
					
					
					
			}
			
			
			
			
			if(isset($_POST['modificaProdotto'])){
					if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/Product.php")){
						require_once("../class/Factory.php");
						require_once("../class/DBmanager.php");
						require_once("../class/Manipulator.php");
						require_once("../class/Product.php");}
					else{
						echo "Error: One of the files does not esist.";
						exit;}
					
				
					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$m = new Manipulator($d);
					
					$f = new Factory($d);
					
					$prod1 = $f->getProductList("Al minuto");
        
				$id=0;
				
				$prName = NULL;
				foreach ($prod1 as $x) {
					
					$id++;
					$st="prodotto" . $id . "";
						if(isset($_POST[$st])){
							
							$prName= $x->getName();
							break;
						}
				}
				
				
				
				if($prName == NULL){
					$prod2 = $f->getProductList("All_ingrosso");
				
					foreach ($prod2 as $x) {
						$id++;	
						$st="prodotto" . $id . "";
						if(isset($_POST[$st])){
							$prName= $x->getName();
							break;
						}
					}
				}
				
				
				if($prName == NULL){
				$prod3 = $f->getProductList("Servizio");
				
				foreach ($prod3 as $x) {
					
					$id++;
					$st="prodotto" . $id . "";
						if(isset($_POST[$st])){
								
							$prName= $x->getName();
							break;
						}
				}
				}	
					
				$y = $f->getProduct($prName);	
				echo "try modify product";
							
							echo "<div id='formmodificaProdotti'>";
							echo "<form action = '' method = 'POST'>";
							echo "Nome prodotto";
							echo "<input type='text' name='nomeProdotto' value='" . $y->getName() . "' required ></br></br>";
							echo "Tipo prodotto";
							
							if($y->getProductType()=="Al minuto"){
								echo "<input type='text' name='tipoProdotto' value='Al minuto' readonly ></br></br>";
								}
							else if($y->getProductType()=="All_ingrosso"){
								echo "<input type='text' name='tipoProdotto' value='All_ingrosso' readonly ></br></br>";
							}
							else {
								echo "<input type='text' name='tipoProdotto' value='Servizio' readonly ></br></br>";
							}
							echo "Ingredienti ";
							echo "<textarea name='ingidientiProdotto' rows='2' cols='100' required>" . $y->getIngredients() . "</textarea></br></br>";
							echo "Descrizione";
							echo "<textarea name='descrizioneProdotto' rows='5' cols='100' required>" . $y->getDesc() . "</textarea></br></br>";
							echo "Percorso imagine prodotto";
							echo "<input type='text' name='percorsoImagineProdotto' placeholder='" . $y->getImage() . "' required ></br></br>";
							echo "<input type='submit' name='confermaModifica' value='Conferma Modifica'></br>";
							echo "</form>";
							echo "</div>";
				$b = $m->removeProduct($y->getName());
				if($b==false){
					echo "Something went wrong try again please.";
				}
				
			}
			
			if(isset($_POST['confermaModifica'])){
				if(isset($_POST['nomeProdotto']) && isset($_POST['ingidientiProdotto']) && isset($_POST['descrizioneProdotto']) && isset($_POST['percorsoImagineProdotto'])){
					if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/Product.php")){
						require_once("../class/Factory.php");
						require_once("../class/DBmanager.php");
						require_once("../class/Manipulator.php");
						require_once("../class/Product.php");}
					else{
						echo "Error: One of the files does not esist.";
						exit;}
					
				
					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$p = new Product($_POST['percorsoImagineProdotto'], $_POST['descrizioneProdotto'], $_POST['ingidientiProdotto'], $_POST['tipoProdotto'], $_POST['nomeProdotto']);
					$m = new Manipulator($d);
					$b = $m->insertProduct($p);
					if($b==false){
						echo "Try inserting the product again please.";
					}
				}
			}
			
			?>
	
</body>
</html>
	