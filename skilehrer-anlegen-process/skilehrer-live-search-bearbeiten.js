/* ----- 
    Suchfunktion für Skilehrer Name. 
    Ergebnisse werde im Formular angezeigt
----- */ 

$(document).ready(function(){
    var obj;
    var queryid;
    $('.search-box input[type="text"]').on("keyup input", function(){ 
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".skilehrerResult");
        
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
                   document.getElementsByClassName('skilehrerResult')[0].innerHTML = "<p>Kein Skilehrer mit diesen Anfangsbuchstaben</p>" ;
                }
                resultDropdown.html(tempArr);
            });
        } else {
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of skilehrerResult item
    
     $(document).on("click", ".skilehrerResult option", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        // Hier muss die ID hinein:
        queryid = this.id;
        document.getElementById('skilehrerid').innerHTML = this.id;

        $.ajax({
            type: "POST",
            url: "/Homepage/skilehrer-anlegen-process/skilehrer-search-complete.php",
            data: {
              id: queryid
            },
            success: function (response) {
                var objx = JSON.parse(response);
                console.log("test");
                console.log(objx);
                console.log(typeof response);
                console.log("hall: " + objx[0].comment);
              document.getElementById('formVornameSkilehrer').value = objx[0].firstname;           
              document.getElementById('formNachnameSkilehrer').value = objx[0].lastname;           
              document.getElementById('phoneSkilehrer').value = objx[0].mobile;           
              document.getElementById('formEmailSkilehrer').value = objx[0].email;           
              document.getElementById('formGeburtsdatumSkilehrer').value = objx[0].birthdate;           
              document.getElementById('formSkiLevelSkilehrer').value = objx[0].skilevel; 
              document.getElementById('formSnowboardLevelSkilehrer').value = objx[0].snowboardlevel;
              
              //Textfeld noch Fehler beim einschreiben von Daten aus DB, wie wird text aus dem Form für Kommentar gespeichert??
              //document.getElementById('formKommentarSkilehrer').value = objx[0].comment;
              
            },
          });

        $(this).parent("").empty();
    }); 

   

});