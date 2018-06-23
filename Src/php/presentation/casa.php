<!DOCTYPE HTML>
<html lang ="it">
  <?php
    require_once("CommonHtmlElement.php");
  	$h = new CommonHtmlElement();
    $h->printHead("casa", "pagina dedicata ai prodotti per la casa", "casa");
  ?>
  <body onload='creaStatistiche()'>
  <?php
        $h->printMobileMenu("home");
    ?>
    <?php
  	   $h->createheader("casa");
       $h->printInternalMenu("casa");
  	?>
    <div id="content">
        <h2>PER LA TUA CASA</h2>
        <div id="info" class="contentElement">
            <h3>SERVIZIO PRENOTAZIONE</h3>
            <p>
                Stanchi di dover venire da noi per ordinare i vostri dolci preferiti? <br/>
                Non preoccupatevi &egrave; online il nuovo serivizio di ordinazione telematico! Ordinate tutto quello che desiderate e venite a ritirarlo presso il negozio quando sar&agrave; pronto. Basta iscriversi! Formaggioso, non trovate?
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
      				 $prod = $f->getProductList("Al minuto");
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
    ?>
  </body>
</html>
