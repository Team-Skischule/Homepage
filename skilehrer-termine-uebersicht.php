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
         <!-- <link href="/Homepage/TimeScheduler-master/css/jquery-ui.css" rel="stylesheet" />
        <link href="/Homepage/TimeScheduler-master/css/jquery.ui.theme.css" rel="stylesheet" /> -->

         <script src="/Homepage/TimeScheduler-master/js/jquery-1.9.1.min.js"></script>
        <!--<script src="/Homepage/TimeScheduler-master/js/jquery-ui-1.10.2.min.js"></script> -->
        <!-- für den bootstrap Kalendar -->
        <link rel="stylesheet" href="bower_components/bootstrap-calendar/css/calendar.css">
		<!-- <link rel="stylesheet" href="bower_components/bootstrap/less/bootstrap.less"> -->

    </head>
    <body>
        <div class="container-fluid">
            <div class="row top-row">
                <div class="col-sm-12">
                    <h1>Hallo </h1>
                    <h2 id="nameElement"></h2>
                    <div class="btn btn-logout btn-logout-skilehrer">
                        <a class="nav-link" href="/Homepage/logout.php">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row skilehrerCalendar">
                <div id="calendar"></div>
            </div>
            <div class="row ">
                <div class="col-sm-12">
                    <div id="terminGrid">
                       <p>Deine aktuellen Termine:<br>(Termine in der Vergangenheit und abgesagte Termine werden nicht angezeigt)</p>
                       <div class="result"></div>
                    </div>
                    <div id="myModal" class="modalbox">
                        <!-- Modal content -->
                        <div class="modalbox-content">
                            <span class="close">&times;</span>
                            <p>insert text here</p>
                            <div class="btn btn-primary submit-btn01">Ja, senden.</div>
                            <div class="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <!-- bootstrap Calendar scripte -->
        
      <!--   <script type="text/javascript" src="bower_components/underscore/underscore.js"></script>
        <script type="text/javascript" src="bower_components/bootstrap-calendar/js/language/de-AT.js"></script>
        <script type="text/javascript" src="bower_components/jquery/dist/jquery.js"></script>
        <script type="text/javascript" src="bower_components/bootstrap-calendar/js/calendar.js"></script>
        <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
        <script type="text/javascript" src="bower_components/moment/moment.js"></script>
		<script type="text/javascript">
        
            function getJson(){
                $.ajax({
                    type: "GET",
                    url: "/Homepage/skilehrer-termine-uebersicht/getSkilehrerTermineJson-Calendar.php",
                    dataType: "html",
                    success: function(data){
                        console.log('success');
                    }
                /*  error: function(data){
                        // error handling
                    } */
                }).done(function(data){
                    // something to do after, even if it throws an error.
                });
            }
            getJson();

            var calendar = $("#calendar").calendar( {language: 'de-AT',  
                events_source: 'http://localhost/Homepage/skilehrer-termine-uebersicht/skilehrerTermine.json'
            });			
		</script> -->
    <!-- bootstrap Calendar scripte -->

    <script>
          var x = "";
        $(document).ready(function(){
            var obj;
        
            /* Get input value on change */
            var inputVal = '<?php echo $session_value;?>';
            
            if(inputVal.length){ 
                
                $.get("/Homepage/skilehrer-termine-uebersicht/getSkilehrerTermineJson.php", {id: inputVal}).done(function(data){

                    // Display the returned data in browser
                    const terminTable = document.getElementById('terminGrid'); 

                    let nameElement = document.querySelector('#nameElement');
                    nameElement.innerHTML = data[0].name;
                    
                    for (x = 0 ; x < data.length; x++) {
                        createAndFillSection(data);
                    }

                    document.addEventListener('click', function(e) {
                        let targetElement = e.target;
                        let classOfIcon = targetElement.classList.value;
                        let terminID = targetElement.parentNode.parentElement.classList.value

                        if(classOfIcon == 'crossP') {
                            openModal(classOfIcon, terminID);
                        }
                        if(classOfIcon == 'questionP') {
                            openModal(classOfIcon, terminID);
                        }
                    });
                });
            } else {
                console.log('user id nicht gefunden: ' + inputVal);
            }
        }); 

        function openModal(classOfIcon, terminID) {
            
            let modalBox = document.querySelector('#myModal');
            modalBox.style.display = "block";

            // Auswahl je nach geklickten Icon
            // Klick auf X ändert den TerminStatus auf 2
            // Klick auf ? ändert den TerminStatus auf 3

            if(classOfIcon == 'crossP') {
                modalBox.childNodes[3].childNodes[3].innerHTML = 'Keine Zeit für diesen Termin';

                // TerminStatus definieren um nachher abzufragen:
                modalBox.childNodes[3].childNodes[7].setAttribute('id', '2');
               
                //button id zufügen
                modalBox.childNodes[3].childNodes[5].setAttribute('id', terminID);
            }

            if(classOfIcon == 'questionP') {
                modalBox.childNodes[3].childNodes[3].innerHTML = 'Bitte Rückruf, abklärung für diesen Termin erwünscht. ';

                // TerminStatus definieren um nachher abzufragen:
                modalBox.childNodes[3].childNodes[7].setAttribute('id', '3');
                
                //button id zufügen
                modalBox.childNodes[3].childNodes[5].setAttribute('id', terminID);
            }

            // PopUp schließen
            var span = document.getElementsByClassName("close")[0];
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modalBox.style.display = "none";
            }
            
            var button = document.getElementsByClassName('btn-primary')[0];
            button.onclick = function() {
                modalBox.style.display = "none";
            }
        }


       
        function createAndFillSection(data) {
             //section
             var section= document.createElement('section');
            section.classList.add(data[x].terminId);
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
            divBottom.classList.add('divBottom');
            var Abholort = document.createElement('p');
            var Kunde = document.createElement('p');
            var crossP = document.createElement('i');
            crossP.classList.add('crossP')
            var questionP = document.createElement('i');

            
                questionP.classList.add('questionP')
            
            crossP.innerHTML = '&#10060;';
            questionP.innerHTML = '&#10067;';
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
            divBottom.appendChild(crossP);
            // wenn der TerminStatus nicht 3 ist (Rückfrage erwünscht), wird die Option auf Rückfrage angezeigt
            if(data[x].status != '3') {
                divBottom.appendChild(questionP);
            } else {
                let rueckmeldungDiv = document.createElement('p');
                rueckmeldungDiv.innerHTML = 'Rückmeldung erwartet';
                rueckmeldungDiv.classList.add('rmErwartet');
                divBottom.appendChild(rueckmeldungDiv);
            }
        }


      </script>

    <script src="/Homepage/skilehrer-termine-uebersicht/termin-status-update.js" 
            crossorigin="anonymous"></script>
    </body> 
    
</html>