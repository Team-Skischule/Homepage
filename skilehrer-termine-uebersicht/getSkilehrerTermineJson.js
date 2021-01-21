/* ---
    Betrifft: Skilehrer Termin Übersicht
--- */
$(document).ready(function(){
    var obj;
    
        /* Get input value on change */
        var inputVal = $_SESSION['id'];
        
        if(inputVal.length){ 
            $.get("/Homepage/skilehrer-termine-uebersicht/getSkilehrerTermineJson.php", {id: inputVal}).done(function(data){

                // Display the returned data in browser
                if (data.length > 0) {    
                    obj = $.parseJSON(data);
                    var tempArr = [];

                    for (x = 0 ; x < obj.length; x++) {
                        tempArr.push('<option id=\"' + obj[x].skilehrerid + '\" >' + obj[x].name + '</option>');
                    }
                } else {
                //    document.getElementsByClassName('skilehrerResult')[0].innerHTML = "<p>Kein Skilehrer mit diesen Anfangsbuchstaben</p>" ;
                }
                resultDropdown.html(tempArr);
            });
        } else {
            console.log('user id: ' + inputVal);
        }
    
});