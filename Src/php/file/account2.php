<!DOCTYPE HTML>
<html lang ="it">
<head>
    <title> Per la Casa - I tesori di <span lang="en">Squitty</span> </title>
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
			<div id="buttonForm">
					<button type="button" id="prenotazione" onclick = "changeContentp()" >Prenotazione</button>
					<button type="button" id="prodotti" onclick = "changeContentprod()">Prodotti al minuto</button>
					<button type="button" id="storia" onclick = "changeContents()">Storia dei ordini</button>
					<button type="button" id="logout"onclick = "changeContentl()" >Log Out</button>
					<button type="button" id="closeaccount"onclick = "changeContentc()" >Close Account</button>



				<script>


					function changeContentprod(){




								document.getElementById("content").innerHTML="
								<p>prodotti</p>
								<div id='_prodotti'>
								<?php


								if(file_exists("Factory.php") && file_exists("DBmanager.php") ){
									require_once("Factory.php");
									require_once("DBmanager.php");}
								else{
									echo "Error: One of the files does not esist.";
									exit;}

								$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty");
								$f = new Factory($d);
								$prod[] = $f->getProductList();
								$arrlength = count($prod);



								for($x = 0; $x < $arrlength; $x++){
									if($prod[$x]->getType()=="Al minuto"){
										echo "<div class='product'>";
										echo "<h4>" . $prod[$x]->getName() . "</h4>";
										echo "<img src='$prod[$x]->getImage()' alt='$prod[$x]->getName()'>";
										echo "<p> Ingredienti:" . $prod[$x]->getIngredienti() . "</p>";
										echo "<p> Descrizione" . $prod[$x]->getDesc() . "</p>";
										echo "</div>";
									}
								}
								?>
								</div> ";

								}

					function changeContents(){
								document.getElementById("content").innerHTML="
								<p>storia</p>
								<div id="_storia">
								<?php

									if(file_exists("Factory.php") && file_exists("DBmanager.php") ){
										require_once("Factory.php");
										require_once("DBmanager.php");}
									else{
										echo "Error: One of the files does not esist.";
										exit;}

									$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty");
									$f = new Factory($d);

									session_start();
									$result = $d->submitQuery("SELECT * FROM USER WHERE email=".$_SESSION[email]);
									$resultLength = count($result);
									if($resultLength > 1){
										echo "Error two users with the same email, conflicted DB.";
										exit;
									}

									$arr = $result->fetch_assoc();
									$Usr =new User($arr['email'], $arr['password'], $arr['nome'], $arr['cognome'], $arr['tipo_utente']);



									$req[] = $f->getRequest($Usr);
									$arrlength = count($req);


									echo "<div class='tabelaStoria'>";
									echo "<table>
										<tr>
										<th>Request status</th>
										<th>Request date and hour</th>
										<th>Delivery date</th>
										</tr>";
										for($x = 0; $x < $arrlength; $x++){
											echo "<tr>";
											echo "<td>" . $req[$x]->getStatus() . "</td>";
											echo "<td>" . $req[$x]->getReiceveRequestDate() . $req[$x]->getReiceveRequestHour() . "</td>";
											echo "<td>" . $req[$x]->getDeliveryDate() . "</td>";
											echo "</tr>";
								//***************** NOT FINISHED PRODUCTS OF A REQUEST MISSING *********************
										}
									echo "</table>";
									echo "</div>";


				?>
				</div>";

				}

				function changeContentl(){
							document.getElementById("content").innerHTML="<?php echo'logout';?>";
						}


				function changeContentc(){
							document.getElementById("content").innerHTML="
								<p>closeaccount</p>
								<div id="_closeaccount">
								<?php
									if(file_exists("Factory.php") && file_exists("DBmanager.php") && file_exists("Authenticator.php")){
										require_once("Factory.php");
										require_once("DBmanager.php");
										require_once "Authenticator.php";}
									else{
										echo "Error: One of the files does not esist.";
										exit;}

									$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty");
									$f = new Factory($d);

									session_start();
									$result = $d->submitQuery("SELECT * FROM USER WHERE email=".$_SESSION[email]);
									$resultLength = count($result);
									if($resultLength > 1){
										echo "Error two users with the same email, conflicted DB.";
										exit;
									}

									$arr = $result->fetch_assoc();
									$Usr =new User($arr['email'], $arr['password'], $arr['nome'], $arr['cognome'], $arr['tipo_utente']);

									$m = new Authenticator();

									$b = $m->removeUser($Usr);

									if($b==FALSE)
									{
										echo "Try closing your account later";
									}
									else
									{
										header("Location: casa.php");

									}
									?>
									</div>";
						}


							function changeContentp(){
							document.getElementById("content").innerHTML="<div id="_prenotazione">
									<h1>Compila la seguente form per ordinare il tuo prodotto.</h1>
									<h2>Premi il buttone Prodotti al minuto per vedere la lista dei prodotti.</h2>
									<?php
										function clean_input($data) {
										$data = trim($data);
										$data = htmlentities($data);
										$data = strip_tags($data);
										return $data;
										}
										$listaProdotti = $numeroProdotti = $descrizioneUtente = $dataRitiro = $oraRitiro = $time = "";
										$ErrListaProdotti = $ErrNumeroProdotti = $ErrDescrizioneUtente = $ErrDataRitiro = $ErrOraRitiro = $ErrTime = "";

										if ($_SERVER["REQUEST_METHOD"] == "POST") {

											if (empty($_POST["listaProdotti"])) {
												$ErrNome = "Product is required";
											}

											if (empty($_POST["numeroProdotti"])) {
												$ErrCognome = "Number of products is required";
											}

											if (empty($_POST["descrizioneUtente"])) {
												$ErrTipoUtente = "User description is required";
											}

											if (empty($_POST["dataRitiro"])) {
												$ErrEmail = "Date is required";
											}
											if (empty($_POST["oraRitiro"])) {
												$ErrPassword = "Time is required";
											}
											if (empty($_POST["time"])) {
												$ErrPassword = "Time is required";
											}

										}
										$listaProdotti = $_POST["listaProdotti"];
										$descrizioneUtente = $_POST["descrizioneUtente"];
										$time = $_POST["time"];

										$numeroProdotti = clean_input($_POST["numeroProdotti"]);
										if (!preg_match("//",$numeroProdotti)) {		//******** YOU HAVE TO FIX IT*******
											$ErrNumeroProdotti = "Invalid number format";
										}

										$dataRitiro = clean_input($_POST[" $dataRitiro"]);
										if (!preg_match("//", $dataRitiro)) {		//******** YOU HAVE TO FIX IT*******
											$ErrDataRitiro = "Invalid number format";
										}

										$oraRitiro = clean_input($_POST["oraRitiro"]);
										if (!preg_match("//",$oraRitiro)) {		//******** YOU HAVE TO FIX IT*******
											$ErrOraRitiro= "Invalid number format";
										}


										if(file_exists("Request.php") && file_exists("DBmanager.php") && file_exists("Manipulator.php")){
											require_once("Request.php");
											require_once("DBmanager.php");
											require_once "Manipulator.php";}
										else{
											echo "Error: One of the files does not esist.";
											exit;}


										$m = new Manipulator($d);
										$currentDate = date("Y/m/d");

										$r = new Request("Al minuto", $currentDate, "in_prenotazione", Usr, strtotime($dataRitiro.$oraRitiro));
										//non e stato finito bisonga iserire una riga anche su ComposizioneAlMinuto

										if($m->insertRequest($r)){
											echo "Successful prenotazione";
										}
									?>


									<div id="ordineForm">
									<form action="" method="post" name="ordineForm">
									<fieldset>

									<legend>Prenotazione</legend>
									<br>
									<?php
										if(file_exists("Factory.php") && file_exists("DBmanager.php") ){
											require_once("Factory.php");
											require_once("DBmanager.php");}
										else{
											echo "Error: One of the files does not esist.";
											exit;
										}

										$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty");
										$f = new Factory($d);
										$prod = $f->getProductList();
										$arrlength = count($prod);

										echo "Prodotto:";
										echo "</br>";
										echo "<select name='listaProdotti' required>";
										echo "<option value=''>--</option>";
										for($x = 0; $x < $arrlength; $x++){
											if($prod[$x]->getType()=="Al minuto"){
												echo "<option value='$prod[$x]->getName()'>".$prod[$x]->getName()."</option>";


												}
										}
										echo "</select>";
										echo "</br>";
									?>
								Numero prodotti:</br>
								<input type="number" name="numeroProdotti"></br>
								Descrizione utente:</br>
								<textarea name="decrizioneUtente" rows="5" cols="30">
								Torta di compleanno con la scrittura "Buon compleanno".
								</textarea></br>
								Data ritiro:</br>
								<input type="date" name="dataRitiro"></br>
								Ora ritiro:</br>
								<input type="number" name="oraRitiro"></br>
								<input type="radio" name="time" value="am">AM
								<input type="radio" name="time" value="pm">PM
								<input type="submit" value="Prenota">
								</fieldset>

							</form>
						</div>
					</div>";

			}
				</script>


				<div id="content">
					bbdjksabk
				</div>


			</div>
	</div>
