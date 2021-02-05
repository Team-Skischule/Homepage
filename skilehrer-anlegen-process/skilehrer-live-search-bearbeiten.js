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
        var resultDropdown = $(this).siblings(".skilehrerResultBearbeiten");
        
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
                   document.getElementsByClassName('skilehrerResultBearbeiten')[0].innerHTML = "<p>Kein Skilehrer mit diesen Anfangsbuchstaben</p>" ;
                }
                resultDropdown.html(tempArr);
            });
        } else {
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of skilehrerResultBearbeiten item
    
     $(document).on("click", ".skilehrerResultBearbeiten option", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        // Hier muss die ID hinein:
        queryid = this.id;
        //document.getElementById('skilehrerid').innerHTML = this.id;
        //einfüllen der Werte von der DB
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
              document.getElementById('skilehreridSkilehrer').value = objx[0].id;
              document.getElementById("formKommentarSkilehrer").innerHTML = objx[0].comment;
              
            },
          });

        $(this).parent("").empty();
    }); 
});

$(document).ready(function () {
    $('#submit_btn2').click(function (e) {
      
  
        e.preventDefault();

        var firstName = $('#formVornameSkilehrer').val();
        var lastName = $('#formNachnameSkilehrer').val();
        var mobile = $('#phoneSkilehrer').val();
        var email = $('#formEmailSkilehrer').val();
        var skiLevel = $('#formSkiLevelSkilehrer').val();
        console.log('skilevel: ' + skiLevel);
        var snowboardLevel = $('#formSnowboardLevelSkilehrer').val();
        console.log('snowboardlevel: ' + snowboardLevel);
        var birthDate = $('#formGeburtsdatumSkilehrer').val();
        var comment = $('#formKommentarSkilehrer').val();
        var id = $('#skilehreridSkilehrer').val();

        console.log("firstname: " + firstName);
        console.log("lastname: " + lastName);
        console.log("mobile: " + mobile);
        console.log("firstname: " + firstName);

        $.ajax
          ({
            type: "POST",
            url: "skilehrer-anlegen-process/skilehrer-update.php",
            data: { 
                "firstname": firstName, 
                "lastname": lastName, 
                "mobile": mobile, 
                "email": email, 
                "skilevel": skiLevel, 
                "snowboardlevel": snowboardLevel, 
                "birthdate": birthDate, 
                "comment": comment,
                "id": id
              },
            success: function (data) {
            $('.result02').html("<div><ol>" + data + "</ol></div>");
            $('#form2')[0].reset();
            $('#formKommentarSkilehrer').empty();
            }
          });
      
    });
  });