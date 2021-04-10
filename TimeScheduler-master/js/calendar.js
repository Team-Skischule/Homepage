// Visual Studio references

/// <reference path="jquery-1.9.1.min.js" />
/// <reference path="jquery-ui-1.10.2.min.js" />
/// <reference path="moment.min.js" />
/// <reference path="timelineScheduler.js" />

var today = moment().startOf("day").add(-2, 'days');

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
      //Timeframe: 60  min * 24 hours * 14 days
      TimeframeOverall: 60 * 24 * 14,
      TimeframeHeaders: ["MMM", "DD"],
      Classes: "period-1week",
    },
    {
      Name: "1 month",
      Label: "4 Wochen",
      TimeframePeriod: 60 * 24 * 1,
      TimeframeOverall: 60 * 24 * 28,
      TimeframeHeaders: ["MMM", "DD"],
      Classes: "period-1month",
    },
    {
      Name: "1 month v2",
      Label: "Monatsansicht",
      TimeframePeriod: 60 * 24 * 1,
      TimeframeOverall: 60 * 24 * 40,
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
    console.log("start: " + (item.end - item.start));
  },

  Item_DoubleClick: function (item) {
    //Gets the skilehrer ID, if a sectionID of an Item is the same ID as a Section
    var skilehrerName = "";
    var skilehrerid = "";

    for (i = 0; i < Calendar.Sections.length; i++) {
      if (Calendar.Sections[i].id == item.sectionID) {
        skilehrerName = Calendar.Sections[i].name;
        skilehrerid = Calendar.Sections[i].id;
      }
    }
    var modal = document.getElementById("myModal");

    //shows Popupwindow
    modal.style.display = "block";

    console.log("Name: " + skilehrerName);
    console.log("skilehrerid: " + skilehrerid);
    console.log("class: " + item.classes);
    document.getElementById("kundennamepopup").value = item.name;
    document.getElementById("abholortpopup").value = item.ort;
    document.getElementById("skilehrernamepopup").value = skilehrerName;
    document.getElementById("statuspopup").value = item.classes;   

    //changes the dates for the DB
    document.getElementById("datumbeginnpopup").value = changeDateStruct(item.start); //moment(item.start).format('YYYY-MM-DD') also works
    document.getElementById("datumendepopup").value = changeDateStruct(item.end);

    //check valid Start / End date
    $(document).ready(function () {
      $("#datumbeginnpopup").change(function () {
        if (new Date(document.getElementById("datumbeginnpopup").value) > new Date(document.getElementById("datumendepopup").value)) {
          document.getElementById("datumbeginnpopup").value = new Date(item.start);
          document.getElementById("livesearchbeginn").innerHTML = "Startdatum darf nicht nach Enddatum sein";
        }else{
          document.getElementById("livesearchbeginn").innerHTML = "";
        }
      }),
        $("#datumendepopup").change(function () {
          if (new Date(document.getElementById("datumbeginnpopup").value) > new Date(document.getElementById("datumendepopup").value)) {
            document.getElementById("datumendepopup").value = new Date(item.ende);
            document.getElementById("livesearchende").innerHTML = "Enddatum darf nicht vor Startdatum sein";
          }else{
            document.getElementById("livesearchende").innerHTML = "";
          }
        });
    });

    //function for the "Speichern" button, sends the Item attributes to the DB (Ajax)
    $(document).ready(function () {
      $("#submit_btnpopup").click(function (e) {
        e.preventDefault();

        let name = $("#kundennamepopup").val();
        let ort = $("#abholortpopup").val();
        let start = $("#datumbeginnpopup").val();
        let end = $("#datumendepopup").val();
        let id = item.id;      

        if ($("#skilehrer-id-popup").val()) {
          skilehrerid = $("#skilehrer-id-popup").val();
        } 

        let status;

        if(document.getElementById("statuspopup").value == "item-status-none"){
          status = 1;
        }
        if(document.getElementById("statuspopup").value == "item-status-one"){
          status = 3;
        }
        if(document.getElementById("statuspopup").value == "item-status-two"){
          status = 2;
        }

        console.log("Search: " + $("#skilehrer-id-popup").val());
        console.log("name: " + name);
        console.log("ort: " + ort);
        console.log("start: " + start);
        console.log("end: " + end);
        console.log("id: " + id);
        console.log("skilehrerid: " + skilehrerid);
        console.log("status: " + status);
        console.log("ENDE Submit Formular");

        $.ajax({
          type: "POST",
          url: "termin-update.php",
          data: {
            "name": name,
            "ort": ort,
            "start": start,
            "end": end,
            "id": id,
            "skilehrerid": skilehrerid,
            "status": status
          },
          success: function (data) {
            $(".resultpopup").html("<div><ol>" + data + "</ol></div>");
            $("#formpopup")[0].reset();
            console.log("Test Form: " + item.id);
            item = "";
            //$('#formKommentarSkilehrer').empty();
            //ladet die Termine frisch in den Kalender
            //versteckt das Popupfenster
            
          },
        });
        setTimeout(() => {
          getItemsTest();
        }, 100);
        modal.style.display = "none";
        console.log("Termin wurde geändert");
      });
    });
    
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
          item="";
        },
      });
      setTimeout(() => {
        getItemsTest();
      }, 100);
      modal.style.display = "none";
      console.log("Termin wurde gelöscht");
    };
    $('#myModal').on('none.bs.modal', function() {
      $('.modal-body').find('input,skilehrer-id-popup,value, data-value').val('');
    })
    TimeScheduler.Init();
    console.log("ENDE DOUBLECLICK EVENT");
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

    var terminStart = changeDateStruct(start);

    //for the end date we need the duration of the Item, start date + the difference to the end date
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

    //item.start & end is the visualization on the Website, before new refresh of Items
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
          item="";
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

    var terminStart = changeDateStruct(start);
    var terminEnde = changeDateStruct(end);    

    item.start = new Date(start).setHours(+0.5);
    item.end = new Date(end).setHours(+21);

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
          item = "";
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

//import of the rownames (Sections) from the DB
function getRowname() {
  // Server query
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var getRownamearr = [];
      getRownamearr = JSON.parse(this.responseText);
      /* ---------------
             json columns:
                id,
                name,
                permission
            ---------------- */

      //fills the Calendar.Sections Array with the JSON Array if they are skiinstructors (permission ==1)
      for (i = 0; i < getRownamearr.length; i++) {
        if (getRownamearr[i].permission == 1) {
          Calendar.Sections.push(getRownamearr[i]);
        }
      }     

      //refreshes rows and columns
      TimeScheduler.Init(true);
    }
  };
  xmlhttp.open("GET", "/Homepage/TimeScheduler-master/getRowname.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send();
}
getRowname();

//Import of all Items in the Database
function getItemsTest() {
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var getItemsArray = JSON.parse(this.responseText);

      /* -------------------------------------------
             json columns:
                sectionID,
                name,
                ort,
                classes,
                start,
                end
            ---------------------------------------- */

      //Calendar.Items is emptied and then filled with the Items from the DB
      Calendar.Items = [];
      for (i = 0; i < getItemsArray.length; i++) {
        //creates a new object newItem with the attributes sectionID, classes, ort, .... 
        var newItem = [];
        newItem.sectionID = getItemsArray[i].sectionID;
        newItem.name = getItemsArray[i].kundenname;
        newItem.ort = getItemsArray[i].abholort;
        newItem.id = getItemsArray[i].id;

        //for a better visualization of the Items we add / substract some hours (only for visualization, DB saves Dates YYYY-MM-DD)
        
        newItem.start = new Date(getItemsArray[i].start);
        newItem.start.setHours(+0.5);
        newItem.end = new Date(getItemsArray[i].end);
        newItem.end.setHours(+21);

        //changes Background of Items according to their class (status)
        if (getItemsArray[i].classes === 1) {
          newItem.classes = "item-status-none";
        }
        if (getItemsArray[i].classes === 3) {
          newItem.classes = "item-status-one";
        }
        if (getItemsArray[i].classes === 2) {
          newItem.classes = "item-status-two";
        }
        //newItem object is added to the Calendar.Items Array (every newItem is one appointment)
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

 //function to change the dateformat for DB
 function changeDateStruct(Datum) {
  let neuDatum = new Date(Datum);
  let neuDatumDay = neuDatum.getDate();
  let neuDatumMonth = neuDatum.getMonth() + 1;
  let neuDatumYear = neuDatum.getFullYear();
  neuDatumMonth = (neuDatumMonth < 10 ? "0" : "") + neuDatumMonth;
  neuDatumDay = (neuDatumDay < 10 ? "0" : "") + neuDatumDay;
  let neuDatumfull = neuDatumYear + "-" + neuDatumMonth + "-" + neuDatumDay;
  return neuDatumfull;}