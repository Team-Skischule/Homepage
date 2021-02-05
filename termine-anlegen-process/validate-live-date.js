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