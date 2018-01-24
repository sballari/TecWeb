<!DOCTYPE HTML>
<html lang ="it">
<<<<<<< HEAD
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
=======
<?php
      if(file_exists("CommonHtmlElement.php")){
        require_once ("CommonHtmlElement.php");}
      else{
        echo "Error: file does not esist.";
        exit;}
      $h = new CommonHtmlElement();
      $h->printHead("Cliente", "pagina personale clienti", "clienti, prenotazioni, ordine, ritiro");
 ?>
>>>>>>> 0c15203f0c86dc28066cc2a85f4cf166db1cd29a
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
			<form>
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
					$u = $f->getUser($_SESSION['Email']);
					$t = $u->getUserType();
					$req = $f->getRequestList($_SESSION['Email']);
					echo "test".$req;
					echo "<div class='tabelaStoria'>";
					switch($t){
						case "Servizio":
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

						case "All_ingrosso":
							echo "<table>
							<tr>
							<th>MassiveOrder product's name</th>
							<th>MassiveOrder product's number</th>
							<th>MassiveOrder periodicity</th>
							<th>MassiveOrder adress</th>
							<th>MassiveOrder receive date and hour</th>
							<th>MassiveOrder status</th>
							<th>MassiveOrder delivery date and hour</th>
							</tr>";
							foreach ($req as $x) {
								echo "<tr>";
								//foreach ($x->getProducts() as $y) {
									//echo "".$y->getName()."";}
								$y = $x->getProducts();
								echo "<td>".$y[0]->getName()."</td>";
								$prodNr = count($y);
								echo "<td>" . $prodNr . "</td>";
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
								<th>RetailOrder product's name</th>
								<th>RetailOrder product's number</th>
								<th>RetailOrder user notes</th>
								<th>RetailOrder receive date and hour</th>
								<th>RetailOrder status</th>
								<th>RetailOrder delivery date and hour</th>
								</tr>";
							foreach ($req as $x) {
								echo "<tr>";
									//foreach ($x->getProducts() as $y) {
										//echo "$y->getName()";}
								$y = $x->getProducts();
								echo "<td>".$y[0]->getName()."</td>";
								$prodNr = count($y);
								echo "<td>" . $prodNr . "</td>";
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

						if(file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/User.php")){

							require_once("../class/DBmanager.php");
							require_once("../class/Manipulator.php");
							require_once("../class/User.php");}
						else{
							echo "Error: One of the files does not esist.";
							exit;}

						$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty");
						$m = new Manipulator($d);
						$b = $m->removeUser($_SESSION['Email']);
						if($b==false){
							echo "Something went wrong. Please try closing your account again.";
						}
						else{
							header("Location: home.php");
						}
				}

				if(isset($_POST['logout'])){
					echo "logout"; //******FIX logout*******
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

						//******VALIDATE ADRESS*****************
						$numeroProdotti = clean_input($_POST['numeroProdotti']);
						if (!preg_match("//",$numeroProdotti)) {		//******** YOU HAVE TO FIX IT*******
							$ErrNumeroProdotti = "Invalid number format";
						}

						$dataRitiro = clean_input($_POST['$dataRitiro']);
						if (!preg_match("//", $dataRitiro)) {		//******** YOU HAVE TO FIX IT*******
							$ErrDataRitiro = "Invalid date format";
						}

						$oraRitiro = clean_input($_POST['oraRitiro']);
						if (!preg_match("//",$oraRitiro)) {		//******** YOU HAVE TO FIX IT*******
							$ErrOraRitiro= "Invalid time format";
						}

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
						$u = $f->getUser($_SESSION['Email']);
						$t = $u->getUserType();
						$m = new Manipulator($d);
						$currentDate = date("Y-m-d");

						switch($t){
							case "Al minuto":
								$r = new RetailOrder($currentDate, "in_prenotazione",  $u , $_POST['descrizioneUtente'], strtotime($dataRitiro.$oraRitiro), NULL );
								$nr = $_POST['numeroPordotti'];
								$Prod = $f->getProduct($_POST['listaProdotti']);
								for($i = 0; $i<$nr; $i++){
									$r->insertProduct($Prod);
								}
								break;

							case "All_ingrosso":
								$r = new MassiveOrder($_POST['indirizzoConsegna'], $_POST['periodicita'], $currentDate, "in_prenotazione",  $u , strtotime($dataRitiro.$oraRitiro), NULL );
								$nr = $_POST['numeroPordotti'];
								$Prod = $f->getProduct($_POST['listaProdotti']);
								for($i = 0; $i<$nr; $i++){
									$r->insertProduct($Prod);
								}
								break;
							case "Servizio":
								$p = $f->getProduct($_POST['listaProdotti']);
								$r = new Service($p, $_POST['personaleRichiesto'], $_POST['risorceNecessarie'], $_POST['indirizzoEvento'], $currentDate, "in_prenotazione",  $u , strtotime($dataRitiro.$oraRitiro), NULL);
								break;
						}

						if($m->insertRequest($r)){
							echo "Successful order.";
						}
						else{
							echo "Try again please.";
						}
					}

				if(isset($_POST['prenotazione'])){

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
					$usr = $f->getUser($_SESSION['Email']);

					$usrType = $usr->getUserType();
					$prod = $f->getProductList($usrType);

					echo "<div id='ordineForm'>";
					echo "<form action='' method='POST' >";
					echo "<fieldset>";
					echo "<legend>Prenotazione</legend>";
					echo "</br>";
					echo "Prodotto:";
					echo "<select name='listaProdotti' required>";
					echo "<option value=''>--</option>";
					foreach ($prod as $x) {
						echo "<option value='" . $x->getName() . "'>" . $x->getName() . "</option>";
					}
					echo "</select>";
					echo "</br></br>";
					echo "Data ritiro/consegna/evento:     <input type='text' name='dataRitiro' placeholder='YYYY-MM-DD' required>";
					echo "</br></br>";
					echo "Ora ritiro/consegna/evento(da 0 a 24):     <input type='text' name='oraRitiro' placeholder='HH:MM:SS' required>";
					echo "</br></br>";

					switch($usrType ){
						case "Al minuto":
							echo "Numero prodotti: <input type='number' name='numeroProdotti' required>";
							echo "</br></br>";
							echo "Descrizione utente:<textarea name='decrizioneUtente' rows='5' cols='30'>Torta di compleanno con la scrittura Buon compleanno.</textarea></br></br>";
							echo "</br></br>";
							break;

						case "All_ingrosso":
							echo "Numero prodotti: <input type='number' name='numeroProdotti' required>";
							echo "</br></br>";
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
					echo "<input type='submit' name='prenota' value='Prenota'>";
					echo "</fieldset>";
					echo "</form>";
					echo "</div>";
				}
				?>
	</body>
</html>
