<!DOCTYPE HTML>
<html lang ="it">
<?php
      if(file_exists("CommonHtmlElement.php")){
        require_once ("CommonHtmlElement.php");}
      else{
        echo "Error: file does not esist.";
        exit;}
      $h = new CommonHtmlElement();
      $h->printHead("home", "home della pasticceria i tesori di squitty", "home");
 ?>
<body>
    <div id="top"></div>
		<?php
			$h->createheader("home");
      $h->printInternalMenu("home");
    ?>



    <div id="content">
        <div id="storia" class="contentElement Right">
            <h2>LA NOSTRA STORIA</h2>
            <img src="../../img/bambino-pasticcere.jpg" alt="immagine storica">
            <p>
                <span lang="en">Squitty</span> &egrave; un personaggio di fantasia… ma fino a un certo punto. Ricordiamo infatti sempre con gratitudine e ammirazione il fondatore della nostra azienda: il topolino <span lang="en">Squitty</span>, che nel 1982 inizi&ograve; una piccola ma preziosa produzione di pasticcini a base di formaggio, in particolare di <span lang="en">Cheesecake</span>, biscotti e sfogliatine. Tempi eroici, di cui rimangono molte testimonianze, la più preziosa delle quali è senz’altro il Ricettario scritto manualmente proprio da <span lang="en">Squitty</span> su un libriccino per topi, ora custodito gelosamente nella cassaforte dell’Azienda.
                La sua figura – così appassionata e importante per la nostra Azienda – è l’ispirazione quotidiana che ci guida in tutto ciò che facciamo; dalla sua esuberanza è nata anche la visione che si ritrova nella conversazione che portiamo avanti giorno dopo giorno, in questa piattaforma web e su tutti i <span lang="en">social network</span> in cui <span lang="en">Squitty</span> &egrave; presente.<br/>
                In particolare, ci soffermiamo sempre sui piaceri della vita in tana, che comprendono le buone ricette di dolci della nostra tradizione rivisitate a base di formaggio, ma anche il piacere dell’Arte del ricevere gli ospiti facendoli sentire a loro agio e il gusto di una tavola sempre ben apparecchiata e accogliente.
            </p>
        </div>
        <div id="negozio" class="contentElement Left" >
            <h2>IL NEGOZIO</h2>
            <img src="../../img/negozio/negozioBambino.jpg" alt="vetrina del negozio">
            <p>
               Nel 1984 fu fondato il negozio, nello stesso locale dove ancor oggi si trova. L’edificio e’ una notevole opera dell’architetto <span lang="de">Benedikter</span> espressamente richiesto del  signor (si fa per dire…) <span lang="en">Squitty</span>. L’architetto si &egrave; ispirato durante la progettazione all’armoniosit&agrave;; e purezza delle forme di formaggio e all’esuberanza del  signor <span lang="en">Squitty</span>. Ogni linea e dettaglio del negozio richiama e rimanda ai principi su cui si fonda la nostra azienda: purezza, semplicit&agrave; e tradizione.<br>
               Fino agli anni 2000 la produzione era interamente svolta nel laboratorio nel  retro bottega, ora la produzione e’ stata spostata nel nostro nuovo stabilimento. Grazie a ci&ograve;; si &agrave; potuta effettuare una notevole espansione del locale atta a rendere più confortevole la permanenza dei nostri affezionati clienti.
            </p>
        </div>
        <div id="stabilimento" class="contentElement Right">
            <h2>LO STABILIMENTO</h2>
            <img src="../../img/stabilimento/Paticceria-Veneto-laboratorio-20%5B1%5D.jpg" alt="laboratorio dolciario">
            <p>
                Gi&agrave; dalla fine degli anni '90, la nostra qualit&agrave; e professionalita’ ha portato alla consolidazione di una clientela sempre più affezionata e alla ricerca di qualit&agrave;. E fu il 1999 l’anno in cui ci trovammo di fronte ad un’ardua scelta: continuare la produzione artigianale nel piccolo  laboratorio o tentare una rischiosa espansione inaugurando un nuovo stabilimento produttivo. Squitty, nonostante le sue minute dimensioni, pensava in grande e la decisione fu ovvia, ma sofferta. Industrializzazione non significa perdita di qualità, ma bensì, offrire la nostra esperienza ad una più ampia clientela. Addirittura, tutto ciò ci ha permesso di elevare i nostri standard focalizzandoci sul miglioramento delle lavorazioni e dei singoli processi cos&igrave; da ottenere un prodotto di maggior qualit&agrave;. L’artigianalit&agrave; &egrave; comunque garantita: le impastatrici sono all’avanguardia ma lavorano lentamente, senza stressare la pasta, i forni assicurano cotture uniformi, con il giusto equilibrio di umidit&agrave; e croccantezza, frighi e vetrine offrono il prodotto così com’&egrave; stato sfornato, nel sapore e nella fragranza. Perch&egrave; i nostri clienti possano ricevere sempre il meglio.
            </p>
        </div>
    </div>
    <?php
			$h->printContatti();
      $h->printFooter();
      $h->printMobileMenu("home");
    ?>
</body>
</html>
