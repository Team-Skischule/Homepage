/* ----------------------------------------------------
-- Server Abfrage nach Skilehrern mit Timer Intervall
------------------------------------------------------*/
    function getSkiLehrerData() {
        // Server Abfrage
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {

            if (this.readyState == 4 && this.status == 200) {
                var getSkilehrerJson  = JSON.parse(this.responseText);
                /* ---------------
                 json ist in mit diesen Spalten befüllt:
                    firstName, 
                    lastName, 
                    id
                ---------------- */
                valueCallBackSkilehrer(getSkilehrerJson);
            }
        }
        xmlhttp.open("GET", "getSkilehrerJson.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }

    function getTermineData() {
        // Server Abfrage
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {

            if (this.readyState == 4 && this.status == 200) {
                var terminJson  = JSON.parse(this.responseText);
                /* ---------------
                 json ist in mit diesen Spalten befüllt:
                    id, 
                    skilehrerid, 
                    status, 
                    datumBeginn, 
                    datumEnde, 
                    timeDiff,
                    kundenName, 
                    abholort
                ---------------- */
                valueCallBackTermine(terminJson);
            }
        }
        xmlhttp.open("GET", "getTermineJson.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }


    getSkiLehrerData();
    getTermineData();
    var skilehrer = [] ;
    var termine = [] ;
    var table = document.querySelector("table");
    
    function valueCallBackSkilehrer(skilehrerJson) {
        skilehrer = skilehrerJson;
        generateTable(table, skilehrer, days);
        generateTableHead(table, days);
    }
    
    valueCallBackTermine = (terminJson) => termine = terminJson;

    
/* ---------------------------------------------
-- Create Table with Name Row and Date Row
---------------------------------------------*/

    // TODO: 
    //      - change number Days by click on buttons (Month / Week)
    //      - Monate und Tage immer zweistellig anzeigen

    var days = '7';
    var startDate = new Date();
    
    function generateTableHead(table, days) {
        let thead = table.createTHead();
        let row = thead.insertRow();
        let th ;
        let text;
        
        skilehrerTHead( row, th, text);
        generateDateColumns(startDate, days, row, th);
    }

    // create Column for Skilehrer in TableHead
    function skilehrerTHead( row, th, text) {
            th = document.createElement('th');
            text = document.createTextNode('Mitarbeiter');
            th.classList.add('slName');
            th.appendChild(text);
            row.appendChild(th);
    }

     // create Columns for Date in TableHead
     function generateDateColumns(startDate, days, row, th) {
        for (i = 0; i< days; i++) {
            th = document.createElement('th');
            th.classList.add('dateTH', 'column_'+i);
            row.appendChild(th);
        }
        fillDateColumns(startDate);
        
    }

    // fill TableHead Columns with Date 
    function fillDateColumns(startDate) {
        let allDateTH = document.querySelectorAll('.dateTH');
        let day = new Date(startDate.setDate((startDate.getDate())));
        let  month = day.getMonth()+1;

        for (i = 0; i< allDateTH.length; i++) {
            allDateTH[i].innerHTML = dayTwoDigit(day) + '.' + monthTwoDigit(day);
            day = new Date(startDate.setDate((startDate.getDate() + 1 )));
        } 
        // StartDate wieder auf ursprung zurücksetzen,.. 
        // ..sonst ist "startDate + 'Variable = Days' Tage" gespeichert
        startDate = new Date(startDate.setDate((startDate.getDate() - days )));
    }

    // create Table Body 
    function generateTable(table, skilehrer, days) {
        var row;
        for (y = 0; y < skilehrer.length; y++) {
            row = table.insertRow();
            row.classList.add('sLid_'+ skilehrer[y].id);
            let cell = row.insertCell();
            cell.classList.add('slName');
            text = document.createTextNode(skilehrer[y].lastName + ' ' + skilehrer[y].firstName );
            cell.appendChild(text);

            // create empty Cells for each Day in Table Body
            for (i=0; i<days; i++) {
                let cell = row.insertCell();
                let text = document.createTextNode('');
                let date = startDate.getFullYear() + '-' + monthTwoDigit(startDate) + '-' + dayTwoDigit(startDate, i);
                
                cell.classList.add(date);
                cell.appendChild(text);
            }
        }
    }

    
/* ----------------------------------------------------
----- Termine in die Tabelle einfügen:
        Jeder Skilehrer hat eine TableRow. 
            Nach der Reihe werden die durchgegangen 
            und Termine zu dem jeweiligen Skilehrer,
            in der passenden Datumsspalte, zugefügt 

        1.  Array mit TableRows erstellen
        2.  TermineJson wird mit foreach iteriert
        2.a     In jeder Iteration wird überprüft ob:
                die SkilehrerId im Terminjson mit der SkilehrerID in der TableRow identisch ist
        3.  Wenn ja,  wird die tableCell (td) markiert
        3.a Mehrtägige Termine werden mit einer Schleife hochgezählt und der jeweilige Tag markiert

        Hinweis: setTimeout weil: zuerst muss die Tabelle erstellt sein, dann wird sie mit Terminen befüllt
---------------------------------------------------- */

    setTimeout(
    function addTermineToTable () {
        var rows = document.querySelectorAll('tbody > tr'); 
        
        for (row = 0; row < rows.length; row++) {
           let rowId = rows[row].className.substr(5) 
           
           for (const termin of termine) {
               let slId = termin.skilehrerid;
               
               // Prüfen ob es für einen Skilehrer einträge im TerminJson gibt:
               if (slId == rowId) {

                    let datumBeginn = termin.datumBeginn;
                    let termindauer = termin.timeDiff;
                    let getslid = document.querySelectorAll('.sLid_' + termin.skilehrerid + '> td')
                   
                    for (i = 1; i<= days ; i++) { // Schleife läuft für die Länge der Tage in der Tabelle (days)
                        // Hier werden die Tage mit der Termindauer hochgezählt. . Diese müssen noch markiert werden.
                        for (let k = 0; k <= termindauer ; k++ ) {
                            let additionalDays = addDays(datumBeginn, k)
                            //console.log('termindauer > 0 : ' + termindauer + ' datumbeginn: ' + datumBeginn + ' AdditionalDays: ' +additionalDays );
                          
                            // hier wird für jeden Tag des Termins eine Markierung eingefügt:
                            if (getslid[i].className == additionalDays  ) { // wenn datum mit id übereinstimmt dann markieren
                               let tdClassNameDatumArray =  document.getElementsByClassName(getslid[i].className)
                               tdClassNameDatumArray[row].style.backgroundColor = "red";
                            }    
                        }
                    }
                } 
            }
        }
    } , 100);

/* --- Tage zu Datum zufügen --- */ 

    function addDays(myDate, days) {
        const newDate = new Date((myDate))
        newDate.setDate(newDate.getDate() + days)
        return newDate.getFullYear() + '-' + monthTwoDigit(newDate) + '-' + dayTwoDigit(newDate)
    }


/* ----------------------------------------------------
----- two digit Month and Day
---------------------------------------------------- */

dayTwoDigit = (date, addDays=0) => ("0" + (date.getDate() + addDays)).slice(-2)
monthTwoDigit = (date) => ("0" + (date.getMonth() + 1)).slice(-2)

/* ----------------------------------------------------
----- Kalender Datum weiter
---------------------------------------------------- */
    // Next & prev Week: add or substract one Week
    function next_week(startDate) {
        let newStartDate = new Date(startDate.setDate(startDate.getDate() + 7)); 
        fillDateColumns(newStartDate);
    }
    
    function prev_week(startDate) {
        let newStartDate = new Date(startDate.setDate(startDate.getDate() - 7)); 
        generateTable(table, skilehrer, days)
        fillDateColumns(newStartDate);
        addTermineToTable();
    }

/* ----------------------------------------------------
----- Switch Monats-/ Wochenansicht Datum weiter
---------------------------------------------------- */
    function getDaysInMonth () {
        let year = startDate.getFullYear();
        let month = startDate.getMonth();

        let daysCount = new Date(year, month, 0).getDate(); // funktioniert auch mit Schaltjahr
        return daysCount;
    }

    function switchToMonthView() {
        days = getDaysInMonth(startDate);
        console.log('switchMonthView clicked. days=' + days);
        let table = document.querySelector("table");
    }

/* ----------------------------------------------------
----- Timerintervall: Set Timer & Stop Timer function
---------------------------------------------------- */
    //var myVar = setInterval(getSkilehrerName, 3000);
    
    function myStopFunction() {
        clearInterval(myVar);
      } 

   

   
    