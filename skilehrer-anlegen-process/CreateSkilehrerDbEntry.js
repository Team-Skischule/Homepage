/* -------------- FUNKTIONS BESCHREIBUNG: ----------------
  bei Klick auf Submit Button wird die funktion aufgerufen
  1.  zuerste werden die InputFelder mit dem Bootstrap / Browser Standard validiert
      -> nur wenn alle Korrekt sind wird der Ajax create Post gestartet.
  2.  danach werden die Einträge im form_submit.php nochmal geprüft
      -> wenn ok auf DB gespeichert und Erfolgsmeldung im Formular
      -> wenn nicht ok kommt eine Fehlermeldung im Formular
  
  INFO: im form_submit wird überprüft ob die E-Mail oder Telefonnummer bereits verwendet wurde.
      falls ja, gibt es einen Hinweis im Formular    
--------------------------------------------------------*/

$(document).ready(function () {
  $('.btn1').click(function (e) {

    function checkInputValidity() {
      var allObjValid = true;
      // alle InputFelder werden gesammelt und überprüft
      var inpObj = document.querySelectorAll('input.form1');
      // Validity Check in Schleife. Wenn nicht Valide dann set allObjValid auf false
      for (i = 0; i < inpObj.length; i++) {
        if (!inpObj[i].checkValidity()) {
          allObjValid = false;
        } 
      } 
      return  allObjValid.valueOf() == true;
    }

    if (checkInputValidity() == true) {
      e.preventDefault();
      var firstName = $('#formVorname').val();
      var lastName = $('#formNachname').val();
      var mobile = $('#phone').val();
      var email = $('#formEmail').val();
      var skiLevel = $('#formSkiLevel').val();
      console.log('skilevel: ' + skiLevel);
      var snowboardLevel = $('#formSnowboardLevel').val();
      console.log('snowboardlevel: ' + snowboardLevel);
      var birthDate = $('#formGeburtsdatum').val();
      var comment = $('#formKommentar').val();
      $.ajax
        ({
          type: "POST",
          url: "skilehrer-anlegen-process/skilehrer_submit.php",
          data: { 
              "firstName": firstName, 
              "lastName": lastName, 
              "mobile": mobile, 
              "email": email, 
              "skiLevel": skiLevel, 
              "snowboardLevel": snowboardLevel, 
              "birthDate": birthDate, 
              "comment": comment
            },
          success: function (data) {
          $('.result01').html("<div><ol>" + data + "</ol></div>");
          $('#form')[0].reset();
          }
        });
    }
  });
});

