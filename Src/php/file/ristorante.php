<!DOCTYPE HTML>
<html lang ="it">
<?php
    require_once ("CommonHtmlElement.php");
    $h = new CommonHtmlElement();
    $h->printHead("ristorante", "pagina dedicata ai prodotti per ristoranti e hotel", "ristorante, hotel, ingrosso");
 ?>
<body>
    <div id="accessBar">
    </div>


    <?php

	$h->createheader("ristorante");
    $h->printInternalMenu("ristorante");
	?>



    <div id="content">
        <h2>PER IL TUO RISTORANTE</h2>

        <div id="info" class="contentElement">
            <h3>SERVIZIO FORNITURE</h3>
            <p>
                <span lang="en">Squitty</span> s&agrave; quant'&egrave; importante per un ristoratore fornire prodotti di qualit&agrave; ai proprio clienti. Ed &egrave; per questo che ha voluto rivoluzionare il laboratorio, creando un catalogo di prodotti adatti per essere utilizzati dagli <span lang="fr">chef</span> delle vostre cucine. Preparazioni per tutti i gusti, ma anche prodotti finiti che potrete servire direttamente ai vostri clienti. Avrete a dispozione un intera flotta di furgoni che ogni mattina partono in direzione dei ristoranti che si affidano a noi, come se non bastasse avrete una tempestiva linea di comunicazione ad hoc verso di noi. Massima flessibilit&agrave;.
            </p>
        </div>
        <div id="productlist">
            <h3>I NOSTRI PRODOTTI</h3>

			<!-- magari fare in forma tabellare???? -->


        <?php

		require_once("../class/Factory.php");
		require_once("../class/DBmanager.php");
		$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
		$d->connect();
		$f = new Factory($d);
		$prod = $f->getProductList("All_ingrosso");


        foreach ($prod as $x) {
						$h->createProductDiv($x);
        }
			?>

        </div>

    </div>
    <?php
      $h->printContatti();
      $h->printFooter();
      $h->printMobileMenu("ristorante");
    ?>
</body>
</html>
