<!DOCTYPE HTML>
<html lang ="it">
<?php
      if(file_exists("CommonHtmlElement.php")){
        require_once ("CommonHtmlElement.php");}
      else{
        echo "Error: file does not esist.";
        exit;}
      $h = new CommonHtmlElement();
      $h->printHead("catering", "pagina dedicata ai servizi catering", "catering");
 ?>
<body>
    <div id="accessBar">
    </div>


    <?php
		if(file_exists("CommonHtmlElement.php")){
				require_once "CommonHtmlElement.php";}
			else{
				echo "Error: file does not esist.";
				exit;}

		$header = new CommonHtmlElement();
		$header->createheader("catering");
    $header->printInternalMenu("catering");
	?>

  <div id ="internalNavBar" class="onlyDesktop" >
    <ul>
      <li><a href="#LoginForm">Login</a></li>
      <li><a href="#info">Info</a></li>
      <li><a href="#productlist">Prodotti ordinabili</a></li>
      <li><a>varie ed eventuali</a></li>
    </ul>
      <div id='logNav'>
      <?php
        $h->generateLogInLink("links");
      ?>
    </div>
  </div>

    <div id="content">
        <h2>CATERING ED EVENTI</h2>

        <div id="info">
            <h3>SERVIZIO CATERING ED EVENTI</h3>
            <p>
                Che sia il diciottesimo di vostro figlio o che sia la presentazione del nuovo prodotto di punta della vostra
                azienda in una prestigiosa cantina, noi ci siamo. Offriamo servizi di Catering pensati ad hoc per ogni occazione.</br>
                Iscriviti al nostro portale telematico ed inserisci le tue richieste. Stai certo che saremo in grado di proporti la soluzione pi&ugrave; adatta alle tue esigenze.</br>
                Sar&agrave; una festa Topomitica.

            </p>
        </div>
        <div id="productlist">
            <h3>I NOSTRI PRODOTTI</h3>

			<!-- magari fare in forma tabellare???? -->
           <?php
				if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php")){
					require_once("../class/Factory.php");
					require_once("../class/DBmanager.php");}
				else{
					echo "Error: One of the files does not esist.";
					exit;}

				$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
				$d->connect();
				$f = new Factory($d);
				$prod = $f->getProductList("Servizio");
        //echo var_dump($prod);

				foreach ($prod as $x) {
						$h->createProductDiv($x);
        }


			?>

        </div>

    </div>
    <?php
			$h->printContatti();
      $h->printFooter();
      $h->printMobileMenu("catering");
    ?>
</body>
</html>
