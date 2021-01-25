<?php
session_start();

/* echo "<h3> PHP List All Session Variables</h3>";
foreach ($_SESSION as $key => $val)
  echo $key . " " . $val . "<br/>"; */
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: /Homepage/login.php");
  exit;
}
$session_value=(isset($_SESSION['id']))?$_SESSION['id']:'';
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
                    <h1>Hallo <?php echo $_SESSION['username']; ?></h1>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-12">
                    <div id="terminGrid">
                        Hier kommen die Termine rein
                    </div>
                </div>
            </div>
        </div>

      <script>
        $(document).ready(function(){
            var obj;
        
            /* Get input value on change */
            var inputVal = '<?php echo $session_value;?>';
            console.log('inputVal: ' + inputVal );
            
            if(inputVal.length){ 

                $.get("/Homepage/skilehrer-termine-uebersicht/getSkilehrerTermineJson.php", {id: inputVal}).done(function(data){

                    // Display the returned data in browser
                    if (data.length > 0) {    
                        const terminTable = document.getElementById('terminGrid'); 
                        
                        console.log(terminTable);

                        for (x = 0 ; x < data.length; x++) {
                            console.log('data.terminId: ' + data[x].terminId)

                            var section= document.createElement('section');
                            section.classList.add('terminId_'+ data[x].terminId);
                            
                            var Beginn = document.createElement('p');
                            Beginn.innerHTML = 'Termin Beginn: ' +  data[x].Beginn ;
                            
                            var Ende = document.createElement('p');
                            Ende.innerHTML = 'Termin Ende: ' +  data[x].Ende ;
                            
                            var Kunde = document.createElement('p');
                            Kunde.innerHTML = 'Kunde: ' +  data[x].Kunde ;
                            
                            var Abholort = document.createElement('p');
                            Abholort.innerHTML = 'Kunde: ' +  data[x].Abholort ;
                            
                            
                            // Reihenfolge in terminGrid Div
                            section.appendChild(Beginn);
                            section.appendChild(Ende);
                            section.appendChild(Kunde);
                            section.appendChild(Abholort);
                            terminTable.appendChild(section);
                            
                            
                        }
                    } else {
                        console.log('Data hat länge von 0');
                    }
                    console.log('Keine ');
                });
            } else {
                console.log('user id nicht gefunden: ' + inputVal);
            }
        });
      </script>
    </body> 
</html>