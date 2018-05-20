<!DOCTYPE HTML>
<html lang ="it">
  <?php
    require_once("CommonHtmlElement.php");
    $h = new CommonHtmlElement();
    $h->printHead("catering", "pagina dedicata ai servizi catering", "catering");
  ?>
  <body onload='creaStatistiche()'>
    <?php
      $h->createheader("catering");
      $h->printInternalMenu("catering");
	  ?>
    <div id="content">
        <h2>CATERING ED EVENTI</h2>
        <div id="info" class="contentElement">
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
            <?php
				      require_once("../services/Factory.php");
					    require_once("../services/DBmanager.php");
				      $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
				      $d->connect();
			       	$f = new Factory($d);
				      $prod = $f->getProductList("Servizio");
              $d->disconnect();
              foreach ($prod as $x) {
						    $h->createProductDiv($x, false);
              }
            ?>
        </div>
      </div>
      <?php
        $h->createStatisticDiv();
			  $h->printContatti();
        $h->printFooter();
        $h->printMobileMenu("catering");
      ?>
  </body>
</html>
