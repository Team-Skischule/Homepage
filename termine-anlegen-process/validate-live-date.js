/* ----- 
    Überprüfen ob das ausgewählte Datum beim ausgewählten Skilehrer verfügbar ist
----- */ 
$(document).ready(function(){
    var obj;
    $('input[type="date"]').on("change input", function(){ 
        
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings("#livesearch"); 
        var skilehrerid = document.getElementById('skilehrerid').textContent;

        if(inputVal.length){ 
            $.get("/Homepage/termine-anlegen-process/validate-date.php", {date: inputVal, id: skilehrerid}).done(function(data){
                // Display the returned data in browser
                if (data.length > 0) {    
                    // es gibt hier kein Json sonder nur eine Info: Termin besetzt oder noch frei
                    console.log('data 2: ' + data);

                   
                } else {
                   document.getElementsByClassName('skilehrerResult')[0].innerHTML = "<p>Kein Skilehrer mit diesen Anfangsbuchstaben</p>" ;
                }
                
                // Hier die Ausgabe anpassen, auf was immer da auch rein passt.
                resultDropdown.html(data);
            });
        } else {
            resultDropdown.empty();
        }
    });
    
});