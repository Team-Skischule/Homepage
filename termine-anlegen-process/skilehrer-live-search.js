/* ----- 
    Suchfunktion für Skilehrer Name. 
    Ergebnisse werde im Formular angezeigt
----- */ 

$(document).ready(function(){
    var obj;
    $('.search-box input[type="text"]').on("keyup input", function(){ 
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".skilehrerResultNeuTermin");
        
        if(inputVal.length){ 
            $.get("/Homepage/termine-anlegen-process/skilehrer-search.php", {term: inputVal}).done(function(data){

                // Display the returned data in browser
                if (data.length > 0) {    
                    obj = $.parseJSON(data);
                    var tempArr = [];

                    for (x = 0 ; x < obj.length; x++) {
                        tempArr.push('<option id=\"' + obj[x].skilehrerid + '\" >' + obj[x].name + '</option>');
                    }
                } else {
                   document.getElementsByClassName('skilehrerResultNeuTermin')[0].innerHTML = "<p>Kein Skilehrer mit diesen Anfangsbuchstaben</p>" ;
                }
                resultDropdown.html(tempArr);
            });
        } else {
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of skilehrerResult item
    
     $(document).on("click", ".skilehrerResultNeuTermin option", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        // Hier muss die ID hinein:
        document.getElementById('skilehreridNeuTermin').innerHTML = this.id;
        document.getElementsByClassName('skilehrer-id-popup')[0].value = this.id;
        $(this).parent("").empty();
    }); 

   

});