<!DOCTYPE HTML>
<html lang ="it">
<?php
      if(file_exists("CommonHtmlElement.php")){
        require_once ("CommonHtmlElement.php");}
      else{
        echo "Error: file does not esist.";
        exit;}
      $h = new CommonHtmlElement();
      $h->printHead("casa", "pagina dedicata ai prodotti per la casa", "casa");
 ?>
<body>
    <div id="accessBar">
    </div>

    <?php
			require_once ("CommonHtmlElement.php");
		$header = new CommonHtmlElement();
		$header->createheader("casa");
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
        <h2>PER LA TUA CASA</h2>

        <div id="info">
            <h3>SERVIZIO PRENOTAZIONE</h3>
            <p>
                Stanchi di dover venire da noi per ordinare i vostri doldi preferiti? <br/>
                Non preoccupatevi &egrave; online il nuovo serivizio di ordinazione telematico! Ordinate tutto quello che desiderate e venite a ritirarlo presso il negozio quando sar&agrave; pronto. Basta iscriversi! Formaggioso, non trovate?
            </p>
        </div>
        <div id="productlist">
            <h3>I NOSTRI PRODOTTI</h3>

			<!-- magari fare in forma tabellare???? -->

			<?php
				if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") ){
					require_once("../class/Factory.php");
					require_once("../class/DBmanager.php");}
				else{
					echo "Error: One of the files does not esist.";
					exit;}

				$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
				$d->connect();
				$f = new Factory($d);
				$prod = $f->getProductList("Al minuto");

        foreach ($prod as $x) {
						echo "<div class='product'>";
						echo "<h4>" . $x->getName() . "</h4>";
            $relativeImagePath = "'../../".$x->getImage()."'";
						echo "<img src=".$relativeImagePath." alt='".$x->getName()."'>";
						echo "<p> Ingredienti:" . $x->getIngredients() . "</p>";
						echo "<p> Descrizione" . $x->getDesc() . "</p>";
						echo "</div>";
        }

			?>

        </div>

    </div>
    <div id="contatti">
        <h3>CONTATTI</h3>
        <p>
            Sempre a vostra disposizione, ci potete trovare ai seguenti recapiti:
        </p>
            <ul>
                <li>negozio: via G. Stilton 44 Jesolo (VE) cap. 30016</li>
                <li>stabilimento: via dell’Innovazione 42 Jesolo (VE) cap. 30016</li>
                <li>mail: info@pasticceriaSquitty.com</li>
                <li>tel: 0421 5841204</li>
                <li>fax: 0421 7493729</li>
            </ul>

    </div>
    <div id="footer">
        <p>
            Sito creato per il progetto didattico di Tecnologie per il Web da parte di: Gerta Llieshi, Alessio Gobbo, Dario Riccardo e Simone Ballarin.
        </p>
        <a href="sitemap.html">sitemap</a>
    </div>

</body>
</html>
