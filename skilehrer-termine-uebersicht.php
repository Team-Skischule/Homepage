<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: /Homepage/login.php");
  exit;
}
if ($_SESSION["permission"] == 0){
    header("location: /Homepage/TimeScheduler-master/Calendar.php");
}
$session_value=(isset($_SESSION["id"]))?$_SESSION["id"]:'';
?>
<!DOCTYPE html>

<html>
    <head runat="server">
    
        <title>Skilehrer Termine Übersicht</title>
        <link rel="stylesheet" href="style.css" />
         <?php include 'includes/header.php';?> 
         <link href="/Homepage/TimeScheduler-master/css/jquery-ui.css" rel="stylesheet" />
        <link href="/Homepage/TimeScheduler-master/css/jquery.ui.theme.css" rel="stylesheet" />

        <script src="/Homepage/TimeScheduler-master/js/jquery-1.9.1.min.js"></script>
        <script src="/Homepage/TimeScheduler-master/js/jquery-ui-1.10.2.min.js"></script>

    </head>
    <body>
        <div class="container-fluid">
            <div class="row top-row">
                <div class="col-sm-12">
                    <h1>Hallo </h1>
                    <h2 id="nameElement"></h2>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-12">
                    <div id="terminGrid">
                       <p>Deine Termine:</p>
                    </div>
                </div>
            </div>
        </div>

      <script>
        $(document).ready(function(){
            var obj;
        
            /* Get input value on change */
            var inputVal = '<?php echo $session_value;?>';
            
            if(inputVal.length){ 
                
                $.get("/Homepage/skilehrer-termine-uebersicht/getSkilehrerTermineJson.php", {id: inputVal}).done(function(data){

                    // Display the returned data in browser
                    if (data.length > 0) {    
                        const terminTable = document.getElementById('terminGrid'); 

                        let nameElement = document.querySelector('#nameElement');
                        nameElement.innerHTML = data[0].name;
                        
                        for (x = 0 ; x < data.length; x++) {
                            //section
                            var section= document.createElement('section');
                            section.classList.add('terminId_'+ data[x].terminId);
                            // divTop
                            var divTop = document.createElement('div');
                            divTop.classList.add('divTop');
                            var p1 = document.createElement('p');
                            var p2 = document.createElement('p');
                            // Datum
                            p1.innerHTML = 'Beginn: ' +  data[x].Beginn ;
                            p2.innerHTML = 'Ende: ' +  data[x].Ende ;
                            
                            // divBottom
                            var divBottom = document.createElement('div');
                            var Abholort = document.createElement('p');
                            var Kunde = document.createElement('p');
                            Kunde.innerHTML = 'Kunde: ' +  data[x].Kunde ;
                            Abholort.innerHTML = 'Abholort: ' +  data[x].Abholort ;

                            // Reihenfolge in terminGrid Div
                            let gridElement = document.getElementById('terminGrid');
                            gridElement.appendChild(section);
                            section.appendChild(divTop);
                            section.appendChild(divBottom);
                            divTop.appendChild(p1);
                            divTop.appendChild(p2);
                            divBottom.appendChild(Kunde);
                            divBottom.appendChild(Abholort);
                        }
                    } else {
                        console.log('Data hat länge von 0');
                    }
                });
            } else {
                console.log('user id nicht gefunden: ' + inputVal);
            }
        });

      </script>
    </body> 
</html>