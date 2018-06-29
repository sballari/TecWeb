<!DOCTYPE HTML>
<html lang ="it">
  <?php
    //session_start();
    require_once("CommonHtmlElement.php");
    require_once("../services/Factory.php");
    require_once("../services/DBmanager.php");

    $h = new CommonHtmlElement();
    $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
    $d->connect();
    $f = new Factory($d);
    $h->printHead('ricerca', "ricerca", "ricerca, dolci, risultati");

 ?>
<body onload='creaStatistiche()'>
<?php
        $h->printMobileMenu("search");
    ?>
    <div id="accessBar">
    </div>

    <?php
  	   $h->createheader("search");
       $h->printInternalMenu("search");
  	?>
    <div id="content">
    <div id="productlist">
    <?php

        $c = $f->searchProdotti($_GET['search']);
        echo "<h2>Trovati ".count($c)." prodotti corrispondenti.</h2>";
        foreach($c as $p){
            $h->createProductDiv($p, true,$_GET['search']);
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
