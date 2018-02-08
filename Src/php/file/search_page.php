<!DOCTYPE HTML>
<html lang ="it"></html>
<?php
    session_start();
    require_once ("CommonHtmlElement.php");
    require_once("../class/Factory.php");
    require_once("../class/DBmanager.php");

    $h = new CommonHtmlElement();
    $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
    $d->connect();
    $f = new Factory($d);
    $h->printHead("ricerca", "ricerca", "ricerca, dolci, risultati");

 ?>
<body>
    <div id="accessBar">
    </div>

    <?php
  	   $h->createheader("account");
       $h->printInternalMenu("account");
  	?>
    <div id="content">
    <?php
        $c = $f->searchProdotti($_GET['search']);
        foreach($c as $p){
            $h->createProductDiv($p);
        }
    ?>

        
    </div>

    <?php
	  $h->printContatti();
      $h->printFooter();
      $h->printMobileMenu("casa");
    ?>


</body>
</html>





