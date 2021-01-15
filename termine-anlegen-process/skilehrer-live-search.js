/* ----- 
    Suchfunktion für Skilehrer
----- */ 

$(document).ready(function(){
    var obj;
    $('.search-box input[type="text"]').on("keyup input", function(){ 
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".skilehrerResult");
        
        if(inputVal.length){ 
            $.get("termine-anlegen-process/skilehrer-search.php", {term: inputVal}).done(function(data){
                console.log('data: ' + data);
                // Display the returned data in browser
                if (data.length > 0) {    
                    obj = $.parseJSON(data);
                    var tempArr = [];
                    for (x = 0 ; x < obj.length; x++) {
                        /* tempArr.push('<p id=\"' + obj[x].skilehrerid + '\" >' + obj[x].name + '</p>');
                        console.log('<p id=\"' + obj[x].skilehrerid + '\" >' + obj[x].name + '</p>'); */

                        tempArr.push('<option id=\"' + obj[x].skilehrerid + '\" >' + obj[x].name + '</option>');
                        console.log('<option id=\"' + obj[x].skilehrerid + '\" >' + obj[x].name + '</option>');

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
        document.getElementById('skilehrerid').innerHTML = this.id;
        $(this).parent("").empty();
    }); 

   

});