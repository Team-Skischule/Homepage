/* ----- 
    Suchfunktion für Skilehrer
----- */ 
var idx;
var thisEl;

$(document).ready(function(){
    var obj;
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");

        if(inputVal.length){ 
            $.get("termine-anlegen-process/skilehrer-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                
                obj = $.parseJSON(data);

                var tempArr = [];
                for (x = 0 ; x < obj.length; x++) {
                    tempArr.push('<p id=\"' + obj[x].skilehrerid + '\" >' + obj[x].name + '</p>');
                    console.log('<p id=\"' + obj[x].skilehrerid + '\" >' + obj[x].name + '</p>');
                }
                
                
                resultDropdown.html(tempArr);
            });
        } else {
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        // Hier muss die ID hinein:
        document.getElementById('skilehrerid').innerHTML = this.id;

        $(this).parent("").empty();

        
    });

});