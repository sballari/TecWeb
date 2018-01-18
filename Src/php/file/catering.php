<!DOCTYPE HTML>
<html lang ="it">
<head>
    <title> Catering - I tesori di <span lang="en">Squitty</span> </title>
    <meta name="title" content="servizio Catering" >
    <meta name="author" content="Simone Ballarin">
    <meta name="description" content="trama della serie <abbr>TBBT</abbr>" >
    <meta name="keywords" content="curiosita" >
    <meta name="language" content="italian it">
    <meta http-equiv="Content-Type" content="text/html; =charset=utf-8">
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
		$header->createheader("catering");
	?>


    <div id ="internalNavBar">
        <ul>
            <li><a href="#LoginForm">Login</a></li>
            <li><a href="#info">Info</a></li>
            <li><a href="#productlist">Prodotti ordinabili</a></li>
            <li><a>varie ed eventuali</a></li>
        </ul>
    </div>
    <div id="content">
        <h2>CATERING ED EVENTI</h2>


         <?php
			if(file_exists("CommonHtmlElement.php")){
				require_once "CommonHtmlElement.php";}
			else{
				echo "Error: file does not esist.";
				exit;}

			$log = new CommonHtmlElement();
			$log->generatelogin();
			$log->generateSignup();
		?>


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
						echo "kot";
						echo "<div class='product'>";
						echo "<h4>" . $x->getName() . "</h4>";
            $relativeImagePath = "'../../".$x->getImage()."'";
						echo "<img src=".$relativeImagePath." alt='".$x->getName()."'>";
						//if($x->getIngredients()!==NULL){
						//echo "<p> Ingredienti:" . $x->getIngredients() . "</p>";}
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
