<!DOCTYPE HTML>
<html lang ="it">
<head>
    <title> Per il Ristorante - I tesori di <span lang="en">Squitty</span> </title>
    <meta name="title" content="fornitura all'ingrosso" >
    <meta name="author" content="Simone Ballarin">
    <meta name="description" content="trama della serie <abbr>TBBT</abbr>" >
    <meta name="keywords" content="curiosita" >
    <meta name="language" content="italian it">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../../css/stile.css">
</head>
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
		$header->createheader("ristorante");
	?>


    <div id ="internalNavBar">
        <ul>
            <li><a href="#LoginForm">Login</a></li>
            <li><a href="#info">Info</a></li>
            <li><a href="#productlist">Forniture possibili</a></li>
            <li><a>varie ed eventuali</a></li>
        </ul>
    </div>
    <div id="content">
        <h2>PER IL TUO RISTORANTE</h2>

        <div id="info">
            <h3>SERVIZIO FORNITURE</h3>
            <p>
                <span lang="en">Squitty</span> s&agrave; quant'&egrave; importante per un ristoratore fornire prodotti di qualit&agrave; ai proprio clienti. Ed &egrave; per questo che ha voluto rivoluzionare il laboratorio, creando un catalogo di prodotti adatti per essere utilizzati dagli <span lang="fr">chef</span> delle vostre cucine. Preparazioni per tutti i gusti, ma anche prodotti finiti che potrete servire direttamente ai vostri clienti. Avrete a dispozione un intera flotta di furgoni che ogni mattina partono in direzione dei ristoranti che si affidano a noi, come se non bastasse avrete una tempestiva linea di comunicazione ad hoc verso di noi. Massima flessibilit&agrave;.
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
				$prod = $f->getProductList("All_ingrosso");
        //echo var_dump($prod);

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
