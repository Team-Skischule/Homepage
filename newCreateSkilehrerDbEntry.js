/* Call Ajax Method */

$(document).ready(function () {
    $('.btn').click(function (e) {
      e.preventDefault();
      var firstName = $('#formVorname').val();
      var lastName = $('#formNachname').val();
      var mobile = $('#phone').val();
      var email = $('#formEmail').val();
      var level = $('#formLevel').val();
      var canSki = $('#formSki').val();
      var canSnowboard = $('#formSnowboard').val();
      var birthDate = $('#formGeburtsdatum').val();
      var comment = $('#formKommentar').val();
      $.ajax
        ({
          type: "POST",
          url: "form_submit.php",
          data: { 
              "firstName": firstName, 
              "lastName": lastName, 
              "mobile": mobile, 
              "email": email, 
              "level": level, 
              "canSki": canSki, 
              "canSnowboard": canSnowboard, 
              "birthDate": birthDate, 
              "comment": comment
             },
          success: function (data) {
            $('.result').html(data);
            $('#form')[0].reset();
          }
        });
    });
  });