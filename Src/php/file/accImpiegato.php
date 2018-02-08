<!DOCTYPE HTML>
<html lang ="it">
<?php
      if(file_exists("CommonHtmlElement.php")){
        require_once ("CommonHtmlElement.php");}
      else{
        echo "Error: file does not esist.";
        exit;}
      $h = new CommonHtmlElement();
      $h->printHead("account impiegato", "pagina dedicata ai impiegati della pasticceria", "account");
 ?>
<body>
      <div id="accessBar">
      </div>

      <?php
      if(file_exists("CommonHtmlElement.php")){
  			require_once ("CommonHtmlElement.php");}
      else{
        echo "Error: file does not esist.";
        exit;}
  		$header = new CommonHtmlElement();
  		$header->createheader("loginSignup");
  	?>
    <div id="accessBar">
    </div>



    <div id ="internalNavBar" class="onlyDesktop" >
      <form action = "" method = "POST">
        <ul>
					<li><input type="submit" name="ordini" value="Ordini"></li>
					<li><input type="submit" name="utente" value="Utente"></li>
					<li><input type="submit" name="prodotti" value="Prodotti"></li>
        </ul>
			</form>
	  </div>
    <div id="content">
			<?php
			session_start();
			if(isset($_POST['ordini']))
			{
				echo "Scegli le categorie dei ordini che vuoi visualizzare.";
				echo "<div id='formOrdini'>";
				echo "<form action = '' method = 'POST'>";
				//echo "Data ritiro";
				//echo "<input type='text' name='dataOrdine' placeholder='YYYY-MM-DD' ></br></br>";
				//echo "Ora ritiro";
				//echo "<input type='text' name='oraOrdine' placeholder='HH:MM:SS' required></br></br>";
				echo "<input type='checkbox' name='Al_minuto' value='Al minuto' checked>Al minuto</br>";
				echo "<input type='checkbox' name='All_ingrosso' value='All_ingrosso' checked>All'ingrosso</br>";
				echo "<input type='checkbox' name='Servizio' value='Servizio' checked>Servizio</br></br>";
				echo "<input type='submit' name='visualizzaOrdini' value='Visualizza Ordini'></br></br>";
				echo "</form>";
				echo "</div>";
			}

			if(isset($_POST['visualizzaOrdini'])){
        if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") && file_exists("../class/User.php") && file_exists("../class/Service.php") && file_exists("../class/RetailOrder.php") && file_exists("../class/MassiveOrder.php")){
          require_once("../class/Factory.php");
          require_once("../class/DBmanager.php");
          require_once("../class/User.php");
          require_once("../class/Request.php");
          require_once("../class/RetailOrder.php");
          require_once("../class/MassiveOrder.php");
          require_once("../class/Service.php");
          }
        else{
          echo "Error: One of the files does not esist.";
          exit;}

				$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
				$d->connect();
        $f = new Factory($d);
        $_SESSION['Al_minuto'] = false;
        $_SESSION['All_ingrosso'] = false;
        $_SESSION['Servizio'] = false;
				$id=0;
        echo "<form action = '' method = 'POST'>";
				echo "<div id='tabelleOrdini'>";

				if(isset($_POST['Al_minuto'])){
          $_SESSION['Al_minuto'] = true;
          echo "<table>
            <tr>
            <th>Seleziona</th>
            <th>RetailOrder codice</th>
            <th>RetailOrder product's(number) and name</th>

            <th>RetailOrder user notes</th>
            <th>RetailOrder receive date and hour</th>
            <th>RetailOrder status</th>
            <th>RetailOrder delivery date and hour </th>
            </tr>";
            $req = $f->getTypeRequestList("Al minuto");
          foreach ($req as $x) {
            $id++;
            echo "<tr>";
            echo "<td><input type='checkbox' name='request" . $id . "' value='request" . $id . "' ></td>";
            echo "<td>" . $x->getKey() . "</td>";

            $prodArr=$x->getProducts();
            $length=count($prodArr);
            $prodNumArr = array();

            for($i=0; $i<$length; $i++){
              $l=0;
              $name=$prodArr[$i]->getName();
              $pos=0;
              if($prodArr[$i] != NULL){
              for($j=0; $j<$length; $j++) {
                if($prodArr[$j]!= NULL){
                  if($name == $prodArr[$j]->getName()){
                    $l++;
                    $prodArr[$j]=NULL;
                    $pos=$j;
                  }
                  else{
                    break;
                  }
                }
              }
              $prodNumArr[$name]= "".$l;
              }
              $i=$pos;
            }
            echo "<td>";
            foreach ($prodNumArr as $key=>$value) {
              echo "(".$value.")  ".$key;
              echo "</br>";
            }
            echo "</td>";
            echo "<td>" . $x->getUserNote() . "</td>";
            echo "<td>" . $x->getReiceveRequestDateTime() . "</td>";
            echo "<td>" . $x->getStatus() . "</td>";
            echo "<td>" . $x->getDeliveryDateTime() . "</td>";
            echo "</tr>";
          }
          echo "</table>";

					}


					if(isset($_POST['All_ingrosso'])){
            $_SESSION['All_ingrosso'] = true;
            echo "<table>
            <tr>
            <th>Seleziona</th>
            <th>MassiveOrder codice</th>
            <th>MassiveOrder product's (number) and name</th>

            <th>MassiveOrder periodicity</th>
            <th>MassiveOrder adress</th>
            <th>MassiveOrder receive date and hour</th>
            <th>MassiveOrder status</th>
            <th>MassiveOrder delivery date and hour </th>
            </tr>";
            $req = $f->getTypeRequestList("All_ingrosso");
            foreach ($req as $x) {
              $id++;
              echo "<tr>";
              echo "<td><input type='checkbox' name='request" . $id . "' value='request" . $id . "' ></td>";
              echo "<td>" . $x->getKey() . "</td>";

              $prodArr=$x->getProducts();
              $length=count($prodArr);
              $prodNumArr = array();

              for($i=0; $i<$length; $i++){
                $l=0;
                $name=$prodArr[$i]->getName();
                $pos=0;
                if($prodArr[$i] != NULL){
                for($j=0; $j<$length; $j++) {
                  if($prodArr[$j]!= NULL){
                    if($name == $prodArr[$j]->getName()){
                      $l++;
                      $prodArr[$j]=NULL;
                      $pos=$j;
                    }
                    else{
                      break;
                    }
                  }
                }
                $prodNumArr[$name]= "".$l;
                }
                $i=$pos;
              }
              echo "<td>";
              foreach ($prodNumArr as $key=>$value) {
                echo "(".$value.")  ".$key;
                echo "</br>";
              }
              echo "</td>";
              echo "<td>" . $x->getPeriodicity() . "</td>";
              echo "<td>" . $x->getDeliveryAdress() . "</td>";
              echo "<td>" . $x->getReiceveRequestDateTime() . "</td>";
              echo "<td>" . $x->getStatus() . "</td>";
              echo "<td>" . $x->getDeliveryDateTime() . "</td>";
              echo "</tr>";
            }
            echo "</table>";
					}


					if(isset($_POST['Servizio'])){
            $_SESSION['Servizio'] = true;
            echo "<table>
            <tr>
            <th>Seleziona</th>
            <th>Request codice</th>
            <th>Request product name</th>
            <th>Request product image</th>
            <th>Request product description</th>
            <th>Request staff</th>
            <th>Request resources</th>
            <th>Request adress</th>
            <th>Request receive date and hour</th>
            <th>MassiveOrder status</th>
            <th>MassiveOrder delivery date and hour </th>
            </tr>";
            $req = $f->getTypeRequestList("Servizio");
            foreach ($req as $x) {
              $id++;
              echo "<tr>";
              echo "<td><input type='checkbox' name='request" . $id . "' value='request" . $id . "' ></td>";
              echo "<td>" . $x->getKey() . "</td>";
              echo "<td>" . $x->getService()->getName() . "</td>";
              echo "<td>" . $x->getService()->getImage() . "</td>";
              echo "<td>" . $x->getService()->getDesc() . "</td>";
              echo "<td>" . $x->getStaffNumber() . "</td>";
              echo "<td>" . $x->getResourceNeeded() . "</td>";
              echo "<td>" . $x->getLocationAdress() . "</td>";
              echo "<td>" . $x->getReiceveRequestDateTime() . "</td>";
              echo "<td>" . $x->getStatus() . "</td>";
              echo "<td>" . $x->getDeliveryDateTime() . "</td>";
              echo "</tr>";
            }
            echo "</table>";
          }
          echo "</br></br>";
          echo "<input type='submit' name='cancellaRichiesta' value='Cancella la richiesta'>";
          echo "</br></br>";
          echo "</br></br>";
          echo "<input type='submit' name='cambiaStato' value='Cambia lo stato della richiesta'>";
          echo "</br></br>";
          echo "</div>";
          echo "</form>";
        }



      if(isset($_POST['cancellaRichiesta'])){
        if(file_exists("../class/Factory.php") && file_exists("../class/Manipulator.php") && file_exists("../class/DBmanager.php") && file_exists("../class/User.php") && file_exists("../class/Service.php") && file_exists("../class/RetailOrder.php") && file_exists("../class/MassiveOrder.php")){
          require_once("../class/Factory.php");
          require_once("../class/Manipulator.php");
          require_once("../class/DBmanager.php");
          require_once("../class/User.php");
          require_once("../class/Request.php");
          require_once("../class/RetailOrder.php");
          require_once("../class/MassiveOrder.php");
          require_once("../class/Service.php");
          }
        else{
          echo "Error: One of the files does not esist.";
          exit;}

        $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
        $d->connect();
        $f = new Factory($d);
        $m = new Manipulator($d);
        $id=1;
        if($_SESSION['Al_minuto']==true){
          $req = $f->getTypeRequestList("Al minuto");
          foreach($req as $x){
            $st="request" . $id . "";
            if(isset($_POST[$st])){
              $b = $m->removeRequest($x->getKey(), "Al minuto");
              if($b==false){
                echo "Something went at removeRequest wrong try again!";
              }
              else{
                echo "The request has been sucessfully removed.";
              }
            }
          $id++;
        }
      }
        if($_SESSION['All_ingrosso']==true){
          $req = $f->getTypeRequestList("All_ingrosso");
          foreach($req as $x){
            $st="request" . $id . "";
            if(isset($_POST[$st])){
              $b = $m->removeRequest($x->getKey(), "All_ingrosso");
              if($b==false){
                echo "Something went at removeRequest wrong try again!";
              }
              else{
                echo "The request has been sucessfully removed.";
              }
            }
          $id++;
        }
      }
        if($_SESSION['Servizio']==true){
          $req = $f->getTypeRequestList("Servizio");
          foreach($req as $x){
            $st="request" . $id . "";
            if(isset($_POST[$st])){
              $b = $m->removeRequest($x->getKey(), "Servizio");
              if($b==false){
                echo "Something went at removeRequest wrong try again!";
              }
              else{
                echo "The request has been sucessfully removed.";
              }
            }
          $id++;
        }
      }
    }



			if(isset($_POST['cambiaStato'])){
        if(file_exists("../class/Factory.php") && file_exists("../class/Manipulator.php") && file_exists("../class/DBmanager.php") && file_exists("../class/User.php") && file_exists("../class/Service.php") && file_exists("../class/RetailOrder.php") && file_exists("../class/MassiveOrder.php")){
          require_once("../class/Factory.php");
          require_once("../class/Manipulator.php");
          require_once("../class/DBmanager.php");
          require_once("../class/User.php");
          require_once("../class/Request.php");
          require_once("../class/RetailOrder.php");
          require_once("../class/MassiveOrder.php");
          require_once("../class/Service.php");
          }
        else{
          echo "Error: One of the files does not esist.";
          exit;}

        $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
        $d->connect();
        $f = new Factory($d);
        $m = new Manipulator($d);
        $id=1;
        if($_SESSION['Al_minuto']==true){
          $req = $f->getTypeRequestList("Al minuto");
          foreach($req as $x){
            $st="request" . $id . "";
            if(isset($_POST[$st])){
              $b = $d->submitQuery("UPDATE prenotazione SET stato_ordine = 'passato' WHERE codice = " . $x->getKey() . "");
              if($b==false){
                echo "Something went at changeState wrong try again!";
              }
              else{
                echo "The request has sucessfully changed state.";
              }
            }
          $id++;
        }
      }
        if($_SESSION['All_ingrosso']==true){
          $req = $f->getTypeRequestList("All_ingrosso");
          foreach($req as $x){
            $st="request" . $id . "";
            if(isset($_POST[$st])){
            $b = $d->submitQuery("UPDATE ordine_all_ingrosso SET stato_ordine = 'passato' WHERE codice = " . $x->getKey() . "");
              if($b==false){
                echo "Something went at changeState wrong try again!";
              }
              else{
                echo "The request has sucessfully changed state.";
              }
            }
          $id++;
        }
      }
        if($_SESSION['Servizio']==true){
          $req = $f->getTypeRequestList("Servizio");
          foreach($req as $x){
            $st="request" . $id . "";
            if(isset($_POST[$st])){
              $b = $d->submitQuery("UPDATE richiesta_servizio SET stato_ordine = 'passato' WHERE codice = " . $x->getKey() . "");
              if($b==false){
                echo "Something went at changeState wrong try again!";
              }
              else{
                echo "The request has sucessfully changed state.";
              }
            }
          $id++;
        }
      }
    }


			if(isset($_POST['utente'])){
				if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php")){
					require_once("../class/Factory.php");
					require_once("../class/DBmanager.php");
					require_once("../class/Manipulator.php");}
				else{
					echo "Error: One of the files does not esist.";
					exit;}


				$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
				$d->connect();
				$f = new Factory($d);
				$usr = $f->getUserList();

				echo "<form action = '' method = 'POST'>";
				if($usr==false){
					echo "Something went wrong! Try again.";
				}
				else{
					echo "<div id='tabelaUtenti'>";
					echo "<table>
							<tr>
							<th>Seleziona</th>
							<th>Nome utente</th>
							<th>Cognome utente</th>
							<th>Email utente</th>
							<th>Password utente</th>
              <th>Tipo utente</th>
							</tr>";
				$id = 0;
				foreach ($usr as $x) {
					$id++;
					echo "<tr>";
					echo "<td>".$id."<input type='checkbox' name='utente" . $id . "' value='utente" . $id . "' >";
					echo "<td>" . $x->getName() . "</td>";
					echo "<td>" . $x->getSurname() . "</td>";
					echo "<td>" . $x->getEmail() . "</td>";
					echo "<td>" . $x->getPassword() . "</td>";
					echo "<td>" . $x->getUserType() . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</div>";
				}
				echo "</br></br>";
				echo "<input type='submit' name='cancellaUtente' value='Cancella'></br>";
				echo "</form>";
			}


				if(isset($_POST['cancellaUtente'])){
					if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php")){
						require_once("../class/Factory.php");
						require_once("../class/DBmanager.php");
						require_once("../class/Manipulator.php");}
					else{
						echo "Error: One of the files does not esist.";
						exit;}


					$d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$m = new Manipulator($d);
					$f = new Factory($d);
					$usr = $f->getUserList();

					$id = 0;
					foreach ($usr as $x) {
					  $id++;
						$st="utente" . $id . "";
						if(isset($_POST[$st])){
              $e = $x->getEmail();
							$b = $m->removeUser($e);
							if($b==false){
                echo "Something went at removeUser wrong try again!";
							}
              else{
                echo "The user has been removed sucessfully!";
              }
            }
          }
        }



        if(isset($_POST['prodotti'])){
          if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php")){
  					require_once("../class/Factory.php");
  					require_once("../class/DBmanager.php");}
  				else{
  					echo "Error: One of the files does not esist.";
  					exit;}

				  $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
				  $d->connect();
				  $f = new Factory($d);
				  $prod = $f->getEntireProductList();
          $id=0;
          echo "<div id='formOrdini'>";
          echo "<form action = '' method = 'POST'>";
          echo "<input type='submit' name='aggiuntaProdotto' value='Aggiungi un nuovo prodotto' ></br>";
          echo "</br></br>";
				  echo "<table>
							<tr>
							<th>Seleziona</th>
							<th>Nome</th>
							<th>Percorso imagine</th>
							<th>Ingredienti</th>
							<th>Descrizione</th>
              <th>Tipo prodotto</th>
							</tr>";
				  foreach ($prod as $x) {
            $id++;
					  echo "<tr>";
					  echo "<td>".$id."<input type='checkbox' name='prodotto" . $id . "' value='prodotto" . $id . "' >";
					  echo "<td>" . $x->getName() . "</td>";
					  echo "<td>" . $x->getImage()  . "</td>";
					  echo "<td>" . $x->getIngredients()  . "</td>";
					  echo "<td>" . $x->getDesc() . "</td>";
            echo "<td>" . $x->getProductType() . "</td>";
					  echo "</tr>";
				  }
          echo "</table>";
          echo "</br></br>";
          echo "<input type='submit' name='cancellaProdotto' value='Cancella prodotto' ></br>";
          echo "</br></br>";
				  echo "Per modificare prodotti devi scegliere i prodotti uno alla volta.";
          echo "</br>";
				  echo "<input type='submit' name='modificaProdotto' value='Modifica prodotto'></br></br>";
          echo "</form>";
				  echo "</div>";
			}



      if(isset($_POST['aggiuntaProdotto'])){
        echo "<div id='formAggiuntaProdotti'>";
				echo "<form action = '' method = 'POST'>";
				echo "Nome prodotto";
				echo "<input type='text' name='nomeProdotto' placeholder='nome' required ></br></br>";
				echo "Tipo prodotto";
				echo "<select name='tipoProdotto' required>";
				echo "<option value='Al minuto'>Al minuto</option>";
				echo "<option value='All_ingrosso'>All_ingrosso</option>";
				echo "<option value='Servizio'>Servizio</option>";
				echo "</select></br></br>";
				echo "Ingredienti ";
				echo "<textarea name='ingidientiProdotto' rows='2' cols='100' >Inserisci ingridienti</textarea></br></br>";
				echo "Descrizione";
				echo "<textarea name='descrizioneProdotto' rows='5' cols='100' required>Inserisci descrizione</textarea></br></br>";
				echo "Percorso imagine prodotto";
				echo "<input type='text' name='percorsoImagineProdotto' placeholder='Inserisci il path del imagine' required ></br></br>";
				echo "<input type='submit' name='inserisciProdotto' value='Inserisci Prodotto'></br>";
				echo "</form>";
				echo "</div>";
      }



      if(isset($_POST['inserisciProdotto'])){
				if(isset($_POST['nomeProdotto']) && isset($_POST['tipoProdotto']) && isset($_POST['ingidientiProdotto']) && isset($_POST['descrizioneProdotto']) && isset($_POST['percorsoImagineProdotto'])){

						if(file_exists("../class/Manipulator.php") && file_exists("../class/DBmanager.php") && file_exists("../class/Product.php")){
							require_once("../class/Manipulator.php");
							require_once("../class/DBmanager.php");
							require_once("../class/Product.php");}
						else{
							echo "Error: One of the files does not esist.";
							exit;}

            $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
						$d->connect();
						$m = new Manipulator($d);
						$p = new Product($_POST['percorsoImagineProdotto'], $_POST['descrizioneProdotto'], $_POST['ingidientiProdotto'], $_POST['tipoProdotto'], $_POST['nomeProdotto']);
						$b = $m->insertProduct($p);
						if($b==false){
							echo "Error! Try again!";
						}
            else{
              echo "The product was sucessfully inserted.";
            }
					}
				}



			   if(isset($_POST['cancellaProdotto'])){
				    if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php")){
						  require_once("../class/Factory.php");
						  require_once("../class/DBmanager.php");
						  require_once("../class/Manipulator.php");}
					  else{
						  echo "Error: One of the files does not esist.";
						  exit;}

            $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					  $d->connect();
					  $m = new Manipulator($d);
					  $f = new Factory($d);
            $prod = $f->getEntireProductList();
            $id=0;
            foreach ($prod as $x) {
              $id++;
					    $st="prodotto" . $id . "";
						  if(isset($_POST[$st])){
                $b = $m->removeProduct($x->getName());
							  if($b==false){
                  echo "Something went at removeProduct wrong try again!";
							  }
                else{
                  echo "Product was removed sucessfully!";
                }
              }
            }
      }



      if(isset($_POST['modificaProdotto'])){
					if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/Product.php")){
						require_once("../class/Factory.php");
						require_once("../class/DBmanager.php");
						require_once("../class/Manipulator.php");
						require_once("../class/Product.php");}
					else{
						echo "Error: One of the files does not esist.";
						exit;}

          $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$m = new Manipulator($d);
          $f = new Factory($d);
          $prod = $f->getEntireProductList();
          $id=0;
          $prName = NULL;

				  foreach ($prod as $x) {
            $id++;
					  $st="prodotto" . $id . "";
						if(isset($_POST[$st])){
              $prName= $x->getName();
							break;
						}
				  }

          $y = $f->getProduct($prName);
				  echo "<div id='formModificaProdotti'>";
					echo "<form action = '' method = 'POST'>";
					echo "Nome prodotto";
					echo "<input type='text' name='nomeProdotto' value='" . $y->getName() . "' required ></br></br>";
					echo "Tipo prodotto";
          if($y->getProductType()=="Al minuto"){
					  echo "<input type='text' name='tipoProdotto' value='Al minuto' readonly ></br></br>";
					}
					else if($y->getProductType()=="All_ingrosso"){
						echo "<input type='text' name='tipoProdotto' value='All_ingrosso' readonly ></br></br>";
					}
					else {
						echo "<input type='text' name='tipoProdotto' value='Servizio' readonly ></br></br>";
					}
					echo "Ingredienti ";
					echo "<textarea name='ingidientiProdotto' rows='2' cols='100' >" . $y->getIngredients() . "</textarea></br></br>";
					echo "Descrizione";
					echo "<textarea name='descrizioneProdotto' rows='5' cols='100' required>" . $y->getDesc() . "</textarea></br></br>";
					echo "Percorso imagine prodotto";
					echo "<input type='text' name='percorsoImagineProdotto' placeholder='" . $y->getImage() . "' required ></br></br>";
					echo "<input type='submit' name='confermaModifica' value='Conferma Modifica'></br>";
					echo "</form>";
					echo "</div>";
          $_SESSION['prodottoModificato'] = $y->getName();
			}



      if(isset($_POST['confermaModifica'])){
				if(isset($_POST['nomeProdotto']) && isset($_POST['ingidientiProdotto']) && isset($_POST['descrizioneProdotto']) && isset($_POST['percorsoImagineProdotto'])){
					if(file_exists("../class/Factory.php") && file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/Product.php")){
						require_once("../class/Factory.php");
						require_once("../class/DBmanager.php");
						require_once("../class/Manipulator.php");
						require_once("../class/Product.php");}
					else{
						echo "Error: One of the files does not esist.";
						exit;}

          $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
					$d->connect();
					$p = new Product($_POST['percorsoImagineProdotto'], $_POST['descrizioneProdotto'], $_POST['ingidientiProdotto'], $_POST['tipoProdotto'], $_POST['nomeProdotto']);
					$m = new Manipulator($d);
          $b1 = $m->removeProduct($_SESSION['prodottoModificato'] );
				  if($b1==false){
					  echo "Something went wrong try again please.";
				  }
					$b2 = $m->insertProduct($p);
					if($b2==false){
						echo "Try inserting the product again please.";
					}
          else{
            echo "The product was sucessfully modified.";
          }
				}
			}

		?>
  </div>
</body>
</html>
