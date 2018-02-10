
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
    function resetStatistiche(){
        delCookie("contatoreSett");
        document.getElementById("statP").innerText = "statistiche resettate!";
        
    }
    
    function creaStatistiche() {

        var testo;

        var contatore = getCookie("contatoreSett");
        if (contatore != "") { //il biscotto esiste
            testo = "Un formaggioso benvenuto anche a te! Questi ultimi sette giorni ci hai visitato "+contatore+" volte!"; 
            setCookie("contatoreSett", Number(contatore)+1, 7);    
            
        } 
        else { //non esiste il biscotto  
            testo = "Un formaggioso benvenuto anche a te! Vedo che sei nuovo, buona permanenza nel nostro sito.";    
            setCookie("contatoreSett", 1, 7);
            
        }
        //testo.concat(document.getElementsByTagName("title")[0].innerText);





        var button =document.createElement("button");
        button.setAttribute("onclick","resetStatistiche()")
        button.innerText = "Resetta le statistiche";

        var par = document.getElementById('pStat');
        par.innerText = testo;
        var statDiv= document.getElementById("statD");
        statDiv.appendChild(button);
        
          
        
    }
    function delCookie(nome) { 
        setCookie(nome, "");
    }


