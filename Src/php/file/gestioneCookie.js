
    function setCookie(cname,cvalue,exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function scriviUltimaPagina(){
        var testo = "";
        var ultimaPagina = getCookie("ultimaPagina");
        if (ultimaPagina != "" && ultimaPagina != document.title) {
            testo = " Vedo che la tua ultima pagina visitata è stata "+
            ultimaPagina+". Spero che tu abbia trovato ciò di cui eri in cerca.";
            setCookie("ultimaPagina", document.title);
            
        }
        else {
            setCookie("ultimaPagina", document.title);
        }
        var t = document.getElementById("pStat").innerText;
        document.getElementById("pStat").innerText = t + testo;
        
    }
    function resetStatistiche(){
        delCookie("contatoreSett");
        delCookie("ultimaPagina");
        document.getElementById("pStat").innerText = "statistiche resettate!";
        
    }
    

    function scriviContSett(){
        var testo;

        var contatore = getCookie("contatoreSett");
        if (contatore != "") { //il biscotto esiste
            if (contatore =="1") testo = "Un formaggioso benvenuto anche a te! Ci hai visitato 1 sola volta!";
            else testo = "Un formaggioso benvenuto anche a te! Ci hai visitato "+contatore+" volte!";
            setCookie("contatoreSett", Number(contatore)+1, 7);     
        } 
        else { //non esiste il biscotto  
            testo = "Un formaggioso benvenuto anche a te! Vedo che sei nuovo, buona permanenza nel nostro sito.";    
            setCookie("contatoreSett", 1, 7);           
        }
        var par = document.getElementById('pStat');
        par.innerText = testo;
    }



    function creaStatistiche() {
        
        scriviContSett();
        scriviUltimaPagina();
        var button =document.createElement("button");
        button.setAttribute("onclick","resetStatistiche()")
        button.innerText = "Resetta le statistiche";

        
        var statDiv= document.getElementById("statD");
        statDiv.appendChild(button);
        
          
        
    }
    function delCookie(nome) { 
        setCookie(nome, "");
    }


