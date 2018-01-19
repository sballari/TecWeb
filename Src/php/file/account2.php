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

			<?php
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

					session_start();
					$u = $f->getUser($_SESSION['email']);
					$t = $u->getType();
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
						//require_once("../class/Request.php");
						require_once("../class/RetailOrder.php");
						require_once("../class/MassiveOrder.php");
						require_once("../class/Service.php");
						}
					else{
						echo "Error: One of the files does not esist.";
						exit;}

					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty");
					$d->connect();
					$f = new Factory($d);

					session_start();

					$u = $f->getUser($_SESSION['email']);
					$t = $u->getType();

					$req = $f->getRequestList($_SESSION['email']);
					echo "<div class='tabelaStoria'>";
					switch($t){
						case "Servizi":

							echo "<table>
							<tr>
							<th>Request product name</th>
							<th>Request product image</th>
							<th>Request product description</th>

							<th>Request staff</th>
							<th>Request resources</th>
							<th>Request adress</th>
							<th>Request receive date and hour</th>
							<th>Request status</th>
							<th>Request delivery date and hour</th>

							</tr>";
							foreach ($req as $x) {

								echo "<tr>";
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

							case "All'ingrosso":

								echo "<table>
									<tr>
									<th>MassiveOrder products names</th>
									<th>MassiveOrder periodicity</th>
									<th>MassiveOrder adress</th>
									<th>MassiveOrder receive date and hour</th>
									<th>MassiveOrder status</th>
									<th>MassiveOrder delivery date and hour</th>

									</tr>";
							foreach ($req as $x) {

								echo "<tr>";
								echo "<td>";
									foreach ($x->getProducts() as $y) {
										echo "$y->getName()";}
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
									<th>RetailOrder products names</th>
									<th>RetailOrder periodicity</th>
									<th>RetailOrder adress</th>
									<th>RetailOrder receive date and hour</th>
									<th>RetailOrder status</th>
									<th>RetailOrder delivery date and hour</th>

									</tr>";
							foreach ($req as $x) {

								echo "<tr>";
								echo "<td>";
									foreach ($x->getProducts() as $y) {
										echo "$y->getName()";}
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


				}
				if(isset($_POST['closeaccount'])){
					echo "<p>closeaccount</p>";
					echo "<div id='_closeaccount'>";

						if(file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/User.php")){

							require_once("../class/DBmanager.php");
							require_once("../class/Manipulator.php");
							require_once("../class/User.php");}
						else{
							echo "Error: One of the files does not esist.";
							exit;}


						session_start();
						$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty");
						$m = new Manipulator($d);



						$b = $m->removeUser($_SESSION['email']);
						if($b==false){
							echo "Something went wrong try closing your account again.";
						}
						else{
							header("Location: home.php");
						}
					echo "</div>";
				}


				if(isset($_POST['logout'])){
					echo "logout"; //******FIX logout*******
					header("Location: home.php");
				}



			?>
			<form action = "" method = "POST">

					<button type="button" name="prodotti" >Prodotti al minuto</button>
					<button type="button" name="storia" >Storia dei ordini</button>
					<button type="button" name="logout" >Log Out</button>
					<button type="button" name="closeaccount" >Close Account</button>
			<form>
		</div>


		<div id="body">
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
					if((isset($_POST['listaProdotti']) && isset($_POST['dataRitiro']) && isset($_POST['oraRitiro']) && isset($_POST['numeroProdotti'])) || (isset($_POST['listaProdotti']) && isset($_POST['dataRitiro']) && isset($_POST['oraRitiro']) && isset($_POST['indirizzoConsegna']) && isset($_POST['periodicita'])) ||  (isset($_POST['listaProdotti']) && isset($_POST['dataRitiro']) && isset($_POST['oraRitiro']) && isset($_POST['personaleRichiesto'])&& isset($_POST['risorceNecessarie']) && isset($_POST['indirizzoEvento']))){
									//if(empty($_POST['listaProdotti'])){
										//$listaProdotti = "";}
									//else{
										$listaProdotti = $_POST['listaProdotti'];
									//}

									//if(empty($_POST['descrizioneUtente'])){
										//$descrizioneUtente = "";}
									//else{
										$descrizioneUtente = $_POST['descrizioneUtente'];
									//}
									//if(empty($_POST['time'])){
										//$time = "";}
									//else{
										$time = $_POST["time"];
									//}

									//if(empty($_POST['numeroProdotti'])){
										//$numeroProdotti = "";}
									//else{
										$numeroProdotti = clean_input($_POST['numeroProdotti']);
										if (!preg_match("//",$numeroProdotti)) {		//******** YOU HAVE TO FIX IT*******
											$ErrNumeroProdotti = "Invalid number format";
										}
									//}

									//if(empty($_POST['$dataRitiro'])){
										//$dataRitiro = "";}
									//else{
										$dataRitiro = clean_input($_POST['$dataRitiro']);
										if (!preg_match("//", $dataRitiro)) {		//******** YOU HAVE TO FIX IT*******
											$ErrDataRitiro = "Invalid number format";
										}
									//}

									//if(empty($_POST['oraRitiro'])){
										//$oraRitiro = "";}
									//else{
										$oraRitiro = clean_input($_POST['oraRitiro']);
										if (!preg_match("//",$oraRitiro)) {		//******** YOU HAVE TO FIX IT*******
											$ErrOraRitiro= "Invalid number format";
										}
									//}


										if(file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/Factory.php") && file_exists("../class/User.php") && file_exists("../class/Product.php") && file_exists("../class/Service.php") && file_exists("../class/RetailOrder.php") && file_exists("../class/MassiveOrder.php")){
											//require_once("../class/Request.php");
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
										$u = $f->getUser($_SESSION['email']);
										$t = $u->getType();
										$m = new Manipulator($d);
										$currentDate = date("Y/m/d");

										switch($t){
											case "Al minuto":

												$r = new RetailOrder($currentDate, "in_prenotazione",  $u , $_POST['descrizioneUtente'], strtotime($dataRitiro.$oraRitiro), NULL );
												$nr = $_POST['numeroPordotti'];
												$Prod = array();
												for($i = 0; $i<$nr; $i++){
													$Prod[] = $f->getProduct($_POST['listaProdotti']);
												}
												$r->insertProduct($Prod);
												if($m->insertRequest($r)){
													echo "Successful prenotazione.";
												}
												else{
													echo "Try again please.";
												}
												break;

											case "All'ingrosso":

												$r = new MassiveOrder($_POST['indirizzoConsegna'], $_POST['periodicita'], $currentDate, "in_prenotazione",  $u , strtotime($dataRitiro.$oraRitiro), NULL );
												$nr = $_POST['numeroPordotti'];
												$Prod = array();
												for($i = 0; $i<$nr; $i++){
													$Prod[] = $f->getProduct($_POST['listaProdotti']);
												}
												$r->insertProduct($Prod);
												if($m->insertRequest($r)){
													echo "Successful massive order.";
												}
												else{
													echo "Try again please.";
												}
												break;

											case "Servizio":
												$p = $f->getProduct($_POST['listaProdotti']);
												$r = new Service($p, $_POST['personaleRichiesto'], $_POST['risorceNecessarie'], $_POST['indirizzoEvento'], $currentDate, "in_prenotazione",  $u , strtotime($dataRitiro.$oraRitiro), NULL, $_POST['indirizzoConsegna'], $_POST['periodicita'] );


												if($m->insertRequest($r)){
													echo "Successfulservice order.";
												}
												else{
													echo "Try again please.";
												}
												break;

										}

					}

									echo "<div id='ordineForm'>";
									echo "<form action='' method='post' name='ordineForm'>";
									echo "<fieldset>";

									echo "<legend>Prenotazione</legend>";
									echo "<br>";

										if(file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/Factory.php") && file_exists("../class/User.php") && file_exists("../class/Product.php") && file_exists("../class/Service.php") && file_exists("../class/RetailOrder.php") && file_exists("../class/MassiveOrder.php")){
											//require_once("../class/Request.php");
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
										$f = new Factory($d);
										$usr = $f->getUser($_POST['email']);
										$ty = $usr->getType();
										$prod = $f->getProductList($ty);


										echo "Prodotto:";
										echo "</br>";
										echo "<select name='listaProdotti' required>";
										echo "<option value=''>--</option>";
										//for($x = 0; $x < $arrlength; $x++){
										foreach ($prod as $x) {
												echo "<option value='$x->getName()'>".$x->getName()."</option>";



										}
										echo "</select>";
										echo "</br>";



								echo "Data ritiro:</br>";
								echo "<input type='date' name='dataRitiro' required></br>";
								echo "Ora ritiro:</br>";
								echo "<input type='number' name='oraRitiro' required></br>";
								echo "<input type='radio' name='time' value='am'>AM";
								echo "<input type='radio' name='time' value='pm'>PM";


									switch($usr->getType()){
										case "Al minuto":
											echo "Numero prodotti:" . "</br>";
											echo "<input type='number' name='numeroProdotti' required></br>";
											echo "Descrizione utente:</br>";
											echo "<textarea name='decrizioneUtente' rows='5' cols='30'>";
											echo "Torta di compleanno con la scrittura Buon compleanno.";
											echo "</textarea></br>";
											break;

										case "All'ingrosso":
											echo "Indirizzo consegna:" . "</br>";
											echo "<input type='text' name='indirizzoConsegna' required></br>";
											echo "Periodicita:</br>";
												echo "<select name='periodicita' required>";
												echo "<option value=''>--</option>";
												echo "<option value='settimanale'>settimanale </option>";
												echo "<option value='mensile'>mensile</option>";
												echo "</select>";
											break;

										case "Servizio":
											echo "Personale richiesto:" . "</br>";
											echo "<input type='number' name='personaleRichiesto' required></br>";
											echo "Risorse necessarie:</br>";
											echo "<textarea name='risorseNecessarie' rows='5' cols='30' required>";
											echo "5 tavole, 20 sedie.";
											echo "</textarea></br>";
											echo "Indirizzo evento:" . "</br>";
											echo "<input type='text' name='indirizzoEvento' required></br>";

											break;
									}
								echo "<input type='submit' value='Prenota'>";
								echo "</fieldset>";
							echo "</form>";
						echo "</div>";
				?>
		</div>


				<div id="content">
					bbdjksabk
				</div>

	</body>
</html>
