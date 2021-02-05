// Visual Studio references

/// <reference path="jquery-1.9.1.min.js" />
/// <reference path="jquery-ui-1.10.2.min.js" />
/// <reference path="moment.min.js" />
/// <reference path="timelineScheduler.js" />

var today = moment().startOf("day");

var Calendar = {
  Periods: [
    /* {
      Name: "3 days",
      Label: "3 Tage",
      TimeframePeriod: 60 * 3,
      TimeframeOverall: 60 * 24 * 3,
      TimeframeHeaders: ["DD MMM", "HH"],
      Classes: "period-3day",
    }, */
    {
      Name: "1 week",
      Label: "2 Wochen",
      TimeframePeriod: 60 * 24,
      TimeframeOverall: 60 * 24 * 14,
      TimeframeHeaders: ["MMM", "DD"],
      Classes: "period-1week",
    },
    {
      Name: "1 month",
      Label: "1 Monat",
      TimeframePeriod: 60 * 24 * 1,
      TimeframeOverall: 60 * 24 * 28,
      TimeframeHeaders: ["MMM", "DD"],
      Classes: "period-1month",
    },
  ],

  Items: [
    /* {
      sectionID: 3,
      name: "Gruppe 3 Kinder",
      classes: "item-status-one",
      start: moment(today).add("days", -1),
      end: moment(today).add("days", 3),
    }, */
  ],

  Sections: [
    /* 
        {
            id: 1,
            name: 'Skilehrer 1'
        },
        {
            id: 2,
            name: 'Skilehrer 2'
        },
        {
            id: 3,
            name: 'Skilehrer 3'
        },
        {
            id: 4,
            name: 'Skilehrer 4'
        }
     */
  ],

  Init: function () {
    TimeScheduler.Options.GetSections = Calendar.GetSections;
    TimeScheduler.Options.GetSchedule = Calendar.GetSchedule;
    TimeScheduler.Options.Start = today;
    TimeScheduler.Options.Periods = Calendar.Periods;
    TimeScheduler.Options.SelectedPeriod = "1 month";
    TimeScheduler.Options.Element = $(".calendar");

    TimeScheduler.Options.AllowDragging = true;
    TimeScheduler.Options.AllowResizing = true;

    TimeScheduler.Options.Events.ItemClicked = Calendar.Item_Clicked;
    //DoubleClick
    TimeScheduler.Options.Events.ItemDoubleClick = Calendar.Item_DoubleClick;

    TimeScheduler.Options.Events.ItemDropped = Calendar.Item_Dragged;
    TimeScheduler.Options.Events.ItemResized = Calendar.Item_Resized;

    TimeScheduler.Options.Events.ItemMovement = Calendar.Item_Movement;
    TimeScheduler.Options.Events.ItemMovementStart =
      Calendar.Item_MovementStart;
    TimeScheduler.Options.Events.ItemMovementEnd = Calendar.Item_MovementEnd;

    TimeScheduler.Options.Text.NextButton = "&nbsp;";
    TimeScheduler.Options.Text.PrevButton = "&nbsp;";

    TimeScheduler.Options.MaxHeight = 100;

    TimeScheduler.Init();
  },

  GetSections: function (callback) {
    callback(Calendar.Sections);
  },

  GetSchedule: function (callback, start, end) {
    callback(Calendar.Items);
  },

  Item_Clicked: function (item) {
    console.log(item);
  },

  Item_DoubleClick: function (item) {
    //Holt sich die Skilehrer Id wenn eine Sectionid mit der sectionid eines Items gleich ist
    var skilehrerName = "";
    var skilehrerid = "";

    for (i = 0; i < Calendar.Sections.length; i++) {
      if (Calendar.Sections[i].id == item.sectionID) {
        skilehrerName = Calendar.Sections[i].name;
        skilehrerid = Calendar.Sections[i].id;
      }
    }
    var modal = document.getElementById("myModal");

    //zeigt PopupFenster an
    modal.style.display = "block";

    console.log("Name: " + skilehrerName);
    document.getElementById("kundennamepopup").value = item.name;
    document.getElementById("abholortpopup").value = item.ort;
    document.getElementById("skilehrernamepopup").value = skilehrerName;

    //Datum bearbeiten damit das Format stimmt
    var neuDat = new Date(item.start);
    var neuDatDay = neuDat.getDate();
    var neuDatMonth = neuDat.getMonth() + 1;
    var neuDatYear = neuDat.getFullYear();
    neuDatMonth = (neuDatMonth < 10 ? "0" : "") + neuDatMonth;
    neuDatDay = (neuDatDay < 10 ? "0" : "") + neuDatDay;
    var neuDatfull = neuDatYear + "-" + neuDatMonth + "-" + neuDatDay;
    document.getElementById("datumbeginnpopup").value = neuDatfull;

    //Datum bearbeiten damit das Format stimmt
    var neuDat2 = new Date(item.end);
    var neuDatDay2 = neuDat2.getDate();
    var neuDatMonth2 = neuDat2.getMonth() + 1;
    var neuDatYear2 = neuDat2.getFullYear();
    neuDatMonth2 = (neuDatMonth2 < 10 ? "0" : "") + neuDatMonth2;
    neuDatDay2 = (neuDatDay2 < 10 ? "0" : "") + neuDatDay2;
    var neuDatfull2 = neuDatYear2 + "-" + neuDatMonth2 + "-" + neuDatDay2;
    document.getElementById("datumendepopup").value = neuDatfull2;

    //Funktion wenn Submit-Button im Popupformular gedrückt wird
    $(document).ready(function () {
      $("#submit_btnpopup").click(function (e) {
        e.preventDefault();

        var name = $("#kundennamepopup").val();
        var ort = $("#abholortpopup").val();
        var start = $("#datumbeginnpopup").val();
        var end = $("#datumendepopup").val();
        var id = item.id;
        if ($("#skilehrer-id-popup").val()) {
          skilehrerid = $("#skilehrer-id-popup").val();
        } else {
          skilehrerid = 0;
        }
        console.log("Search: " + $("#skilehrer-id-popup").val());
        console.log("name: " + name);
        console.log("ort: " + ort);
        console.log("start: " + start);
        console.log("end: " + end);
        console.log("id: " + id);
        console.log("skilehrerid: " + skilehrerid);

        $.ajax({
          type: "POST",
          url: "termin-update.php",
          data: {
            name: name,
            ort: ort,
            start: start,
            end: end,
            id: id,
            skilehrerid: skilehrerid,
          },
          success: function (data) {
            $(".resultpopup").html("<div><ol>" + data + "</ol></div>");
            $("#formpopup")[0].reset();
            //$('#formKommentarSkilehrer').empty();
            //ladet die Termine frisch in den Kalender
            getItemsTest();
            //versteckt das Popupfenster
            modal.style.display = "none";
          },
        });
      });
    });

    /* modal.childNodes[3].childNodes[3].innerHTML =
      "Skilehrer: " + skilehrerName +
      "<br>Kundenname: " + item.name +
      "<br>Abholort: " + item.ort +
      "<br>Start: " + item.start.getDate() + " " + item.start.toLocaleString("default", { month: "long" }) + " " + item.start.getFullYear() +
      "<br>Ende: " + item.end.getDate() + " " + item.end.toLocaleString("default", { month: "long" }) + " " + item.end.getFullYear();
 */
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
      modal.style.display = "none";
    };

    // Delete Termin Button
    var btn = document.getElementById("deleteTermin");

    //delete Termin Funktion
    btn.onclick = function () {
      console.log("Item.id: ");
      console.log(item.id);

      $.ajax({
        type: "POST",
        url: "/Homepage/deleteTermin.php",
        data: {
          id: item.id,
        },
        success: function (data) {
          $(".result1").html("<div><ol>" + data + "</ol></div>");
        },
      });
      setTimeout(() => {
        getItemsTest();
      }, 100);
      modal.style.display = "none";
      console.log("Termin wurde gelöscht");
    };
  },

  Item_Dragged: function (item, sectionID, start, end) {
    var foundItem;

    var x = item.end - item.start;
    //richtige Differenz!
    var difference = Math.round(x / (1000 * 3600 * 24));
    var xx = new Date(start);
    xx.setDate(xx.getDate() + difference);

    item.start = start;
    item.end = end;
    item.sectionID = sectionID;

    var terminStart = new Date(start);
    var d = terminStart.getDate();
    //monat +1 weil die monate von 0 (januar) gezählt werden, Datenbank speicher Januar mit 01 ab
    var m = terminStart.getMonth();
    m += 1;
    var y = terminStart.getFullYear();

    if (m < 10) {
      terminStart = y + "-" + "0" + m + "-" + d;
    } else {
      terminStart = y + "-" + m + "-" + d;
    }

    var terminEnde = new Date(start);
    terminEnde.setDate(terminEnde.getDate() + (difference - 1));
    var x = new Date(terminEnde).getDate();
    var h = new Date(terminEnde).getMonth();
    h += 1;
    var z = new Date(terminEnde).getFullYear();

    if (h < 10) {
      terminEnde = z + "-" + "0" + h + "-" + x;
    } else {
      terminEnde = z + "-" + h + "-" + x;
    }

    //Darstellung beim Kalender
    item.start = new Date(start);
    item.end = new Date(end);

    console.log("start: " + terminStart);
    console.log("end: " + terminEnde);

    function ajaxCall() {
      $.ajax({
        type: "POST",
        url: "/Homepage/dragItem.php",
        data: {
          start: terminStart,
          end: terminEnde,
          sectionID: sectionID,
          id: item.id,
        },
        success: function (data) {
          $(".result1").html("<div><ol>" + data + "</ol></div>");
        },
      });
      setTimeout(() => {
        getItemsTest();
      }, 50);
    }
    ajaxCall();
    TimeScheduler.Init();
  },

  Item_Resized: function (item, start, end) {
    var foundItem;

    console.log("Item: ");
    console.log(item);
    console.log("Start: ");
    console.log(start);
    console.log("End: ");
    console.log(end);
    console.log("ID: ");
    console.log(item.id);

    var terminStart = new Date(start);
    var d = terminStart.getDate();
    //monat +1 weil die monate von 0 (januar) gezählt werden, Datenbank speicher Januar mit 01 ab
    var m = terminStart.getMonth();
    m += 1;
    var y = terminStart.getFullYear();

    if (m < 10) {
      terminStart = y + "-" + "0" + m + "-" + d;
    } else {
      terminStart = y + "-" + m + "-" + d;
    }

    var terminEnde = new Date(end);
    var x = terminEnde.getDate();
    var h = terminEnde.getMonth();
    h += 1;
    var z = terminEnde.getFullYear();

    if (h < 10) {
      terminEnde = z + "-" + "0" + h + "-" + x;
    } else {
      terminEnde = z + "-" + h + "-" + x;
    }

    item.start = new Date(start).setHours(-0.5);
    item.end = new Date(end).setHours(+23);

    console.log("start: " + terminStart);
    console.log("end: " + terminEnde);

    function ajaxCall() {
      console.log("Item");
      console.log(item.start);
      $.ajax({
        type: "POST",
        url: "/Homepage/resizeItem.php",
        data: {
          start: terminStart,
          end: terminEnde,
          id: item.id,
        },
        success: function (data) {
          $(".result1").html("<div><ol>" + data + "</ol></div>");
        },
      });
    }
    ajaxCall();
    TimeScheduler.Init();
  },

  Item_Movement: function (item, start, end) {
    var html;

    html = "<div>";
    html += "   <div>";
    html += "       Start: " + start; //.format("DD MMM YYYY");
    html += "   </div>";
    html += "   <div>";
    html += "       End: " + end; //.format("DD MMM YYYY");
    html += "   </div>";
    html += "</div>";

    $(".realtime-info").empty().append(html);
  },

  Item_MovementStart: function () {
    $(".realtime-info").show();
  },

  Item_MovementEnd: function () {
    $(".realtime-info").hide();
  },
};

//Import der Zeilennamen (Sections) von der Datenbank
function getRowname() {
  // Server Abfrage
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var getRownamearr = [];
      getRownamearr = JSON.parse(this.responseText);
      /* ---------------
             json ist in mit diesen Spalten befüllt:
                id,
                name,
                permission
            ---------------- */

      //befüllt Calendar.Sections mit dem JSON Array wenn sie Skilehrer sind (permission == 1)
      for (i = 0; i < getRownamearr.length; i++) {
        if (getRownamearr[i].permission == 1) {
          Calendar.Sections.push(getRownamearr[i]);
        }
      }
      //befüllt Spalten mit allen Einträgen aus der Datenbank
      //Calendar.Sections = getRownamearr;

      //aktualisiert Zeilen und Termine
      TimeScheduler.Init(true);
    }
  };
  xmlhttp.open("GET", "/Homepage/TimeScheduler-master/getRowname.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send();
}
getRowname();

//Import der Termine (Items) von der Datenbank
function getItemsTest() {
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var getItemsArray = JSON.parse(this.responseText);

      /* -------------------------------------------
             json ist in mit diesen Spalten befüllt:
                sectionID,
                name,
                classes,
                start,
                end
            ---------------------------------------- */

      //alle Inhalte von Calendar.Items werden gelöscht und dann neu befüllt
      Calendar.Items = [];
      for (i = 0; i < getItemsArray.length; i++) {
        //es wird ein neues Objekt newItem mit den Attributen sectionID, classes... erstellt
        var newItem = [];
        newItem.sectionID = getItemsArray[i].sectionID;
        //newItem.classes = getItemsArray[i].classes;

        newItem.name = getItemsArray[i].kundenname;
        newItem.ort = getItemsArray[i].abholort;
        newItem.id = getItemsArray[i].id;

        //Zuweisung Anfang/Ende Termin
        //wenn Termin nur ein Tag ist, wird dem End-Datum 23 Stunden zugefügt
        //ansonsten wird für die graphische Darstellung am Anfang eine 0.5h und am Ende -1h

        newItem.start = new Date(getItemsArray[i].start);
        newItem.start.setHours(+1);
        newItem.end = new Date(getItemsArray[i].end);
        newItem.end.setHours(+23);

        //weißt dem Termin die Hintergrundfarbe zu
        //entsprechend der Status-Spalte in der Datenbank
        if (getItemsArray[i].classes === 1) {
          newItem.classes = "item-status-none";
        }
        if (getItemsArray[i].classes === 2) {
          newItem.classes = "item-status-one";
        }
        if (getItemsArray[i].classes === 3) {
          newItem.classes = "item-status-two";
        }

        //newItems Objekt wird dem Array Calendar.Items hinzugefügt
        //jedes Objekt entspricht einem neuen Termin
        Calendar.Items.push(newItem);
      }
      TimeScheduler.Init(true);
    }
  };
  xmlhttp.open("GET", "/Homepage/TimeScheduler-master/getItems.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send();
}
getItemsTest();

$(document).ready(Calendar.Init);
