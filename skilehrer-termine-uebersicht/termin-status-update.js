/* -------------- FUNKTIONS BESCHREIBUNG: ----------------
  bei Klick auf Submit Button in der ModalBox wird die Funktion aufgerufen    
--------------------------------------------------------*/

$(document).ready(function () {
    $('.submit-btn01').click(function (e) {

        const terminId = document.getElementsByClassName('btn-primary');
        const newTerminStatus = document.getElementsByClassName('status')

        if(terminId.length > 1) {
            console.error('Error: zuviele buttons gefunden')
        } else {
            console.log('ok an ajax übergeben' + terminId[0].id + ' newTerminStatus: '+ newTerminStatus[0].id)
        
            $.ajax
                ({
                    type: "POST",
                    url: "skilehrer-termine-uebersicht/termin-status-update.php",
                    data: { 
                        "terminid": terminId[0].id,
                        "newTerminStatus": newTerminStatus[0].id
                    },
                    success: function (data) {
                        $('.result').html("<div><ol>" + data + "</ol></div>");
                        setTimeout(function(){ 
                            location.reload();
                        }, 2000);
                    
                    }
                });
        }
            
    });
  });
  
  