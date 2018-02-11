<!DOCTYPE HTML>
<html lang ="it">
<?php
      require_once ("CommonHtmlElement.php");
      $h = new CommonHtmlElement();
      $h->printHead("casa", "pagina dedicata ai prodotti per la casa", "casa");
 ?>
<body onload='creaStatistiche()'>
    <div id="accessBar">
    </div>

    <?php
  	   $h->createheader("sitemap");
       $h->printInternalMenu("sitemap");
  	?>
    <div id="content">
    <div id='sitemap' class="contentElement">
        <h2>SITEMAP</h2>
        <h3>Pagine Principali</h3>
        <ul>
                <li><a href='home.php'>Home</a></li>
				<li><a href='casa.php'>Per la tua casa</a></li>
				<li><a href='ristorante.php'>Per il tuo ristorante</a></li>
                <li><a href='catering.php'>Catering ed Eventi</a></li>
                
        </ul>
        <h3>Pagine Area Privata</h3>
        <ul>
                <li><a href='logIn.php'>Log In</a></li>
				<li><a href='singUp.php'>Sign Up</a></li>
        </ul>
    </div>
    </div>
        

    <?php
    $h->createStatisticDiv();
	$h->printContatti();
    $h->printFooter();
    $h->printMobileMenu("sitemap");
    ?>


</body>
</html>
