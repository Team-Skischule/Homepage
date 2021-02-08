/* ----- 
    Überprüfen ob das ausgewählte Datum beim ausgewählten Skilehrer verfügbar ist
----- */ 
$(document).ready(function(){
    var obj;
    $('input[type="date"]').on("change input", function(){ 
        
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings("#livesearch"); 
        var skilehrerid = document.getElementById('skilehreridNeuTermin').textContent;

        if(inputVal.length){ 
            $.get("/Homepage/termine-anlegen-process/validate-date.php", {date: inputVal, id: skilehrerid}).done(function(data){
                
                // Display the returned data in browser: Termin besetzt oder noch frei
                
                resultDropdown.html(data);
            });
        } else {
            resultDropdown.empty();
        }
    });
});

//check valid Start / End date
$(document).ready(function () {
    $("#beginnNeuTermin").on("change input", function () {
      if (new Date(document.getElementById("beginnNeuTermin").value) > new Date(document.getElementById("endeNeuTermin").value)) {
        document.getElementById("beginnNeuTermin").value = "";
        document.getElementById("livesearchNeuTerminBeginn").innerHTML = "Startdatum darf nicht nach Enddatum sein";
      }else{
        document.getElementById("livesearchNeuTerminBeginn").innerHTML = "";
      }
    }),
      $("#endeNeuTermin").change(function () {
        if (new Date(document.getElementById("beginnNeuTermin").value) > new Date(document.getElementById("endeNeuTermin").value)) {
        document.getElementById("endeNeuTermin").value = "";
        document.getElementById("livesearchNeuTerminEnde").innerHTML = "Enddatum darf nicht vor Startdatum sein";
        }else{
          document.getElementById("livesearchNeuTerminEnde").innerHTML = "";
        }
      });
  });