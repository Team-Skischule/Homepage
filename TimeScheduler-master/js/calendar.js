// Visual Studio references

/// <reference path="jquery-1.9.1.min.js" />
/// <reference path="jquery-ui-1.10.2.min.js" />
/// <reference path="moment.min.js" />
/// <reference path="timelineScheduler.js" />

var today = moment().startOf("day");

var Calendar = {
  Periods: [
    {
      Name: "3 days",
      Label: "3 Tage",
      TimeframePeriod: 60 * 3,
      TimeframeOverall: 60 * 24 * 3,
      TimeframeHeaders: ["DD MMM", "HH"],
      Classes: "period-3day",
    },
    {
      Name: "1 week",
      Label: "1 Woche",
      TimeframePeriod: 60 * 24,
      TimeframeOverall: 60 * 24 * 7,
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
    {
      sectionID: 3,
      name: "Gruppe 3 Kinder",
      classes: "item-status-one",
      start: moment(today).add("days", -1),
      end: moment(today).add("days", 3),
    },
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
    TimeScheduler.Options.SelectedPeriod = "1 week";
    TimeScheduler.Options.Element = $(".calendar");

    TimeScheduler.Options.AllowDragging = true;
    TimeScheduler.Options.AllowResizing = true;

    TimeScheduler.Options.Events.ItemClicked = Calendar.Item_Clicked;
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

    /* var modal = document.getElementById("myModal");
    
    modal.style.display = "block";
    let p = document.querySelector('#myModal');
    p.childNodes[3].childNodes[3].innerHTML = 
      'Item: ' + item.name + 
      ' <br>Start: ' + item.start + 
      ' <br>Ende: ' + item.end;
  
      // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    } */

  },

  Item_Dragged: function (item, sectionID, start, end) {
    var foundItem;

    console.log(item);
    console.log(sectionID);
    console.log(start);
    console.log(end);

    for (var i = 0; i < Calendar.Items.length; i++) {
      foundItem = Calendar.Items[i];

      if (foundItem.id === item.id) {
        foundItem.sectionID = sectionID;
        foundItem.start = start;
        foundItem.end = end;

        Calendar.Items[i] = foundItem;
      }
    }

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
    var m = terminStart.getMonth();
    m +=1;
    var y = terminStart.getFullYear();

    if(m < 10)
    {
      terminStart = y + "-" + "0" + m + "-" + d;
    } else{
      terminStart = y + "-" + m + "-" + d;
    }

    var terminEnde = new Date(end);
    var x = terminEnde.getDate();
    var h = terminEnde.getMonth();
    h +=1;
    var z = terminEnde.getFullYear();

    if(h < 10)
    {
      terminEnde = z + "-" + "0" + h + "-" + x;     
    } else{
      terminEnde = z + "-" + h + "-" + x;     
    }

    item.start = new Date(start).setHours(+ 0.5);
    item.end = new Date(end).setHours(+ 23);

    console.log("start: " + terminStart);
    console.log("end: " + terminEnde);
    
    function ajaxCall() {
      console.log("Item");
      console.log(item.start);
      $.ajax
          ({
            type: "POST",
            url: "/Homepage/resizeItem.php",
            data: { 
                "start": terminStart, 
                "end": terminEnde, 
                "id": item.id
              },
            
          });

  }
ajaxCall();
    

    /* if(Math.abs(start.getTime() - end.getTime()) / 1000 / 3600 < 12)
    {
    item.start = new Date(start).setHours(+ 0.5);
    item.end = new Date(end).setHours(+ 23);
    }
    item.start = new Date(start).setHours(+ 0.5);
    item.end = new Date(end).setHours(- 1); */



    /*  for (var i = 0; i < Calendar.Items.length; i++) {
      foundItem = Calendar.Items[i];
console.log(foundItem);
      if (foundItem.id === item.id) {
        console.log("Item: "+foundItem.id);
        foundItem.start = start;
        foundItem.end = end;

        Calendar.Items[i] = foundItem;
      }
    } */

    TimeScheduler.Init();
  },

  Item_Movement: function (item, start, end) {
    var html;

    html = "<div>";
    html += "   <div>";
    html += "       Start: " + start;//.format("DD MMM YYYY");
    html += "   </div>";
    html += "   <div>";
    html += "       End: " + end;//.format("DD MMM YYYY");
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
/* console.log("Anfang Inhalt Items");
console.log(Calendar.Items); */

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
                name
            ---------------- */

      //befüllt Calendar.Sections mit dem JSON Array
      Calendar.Sections = getRownamearr;
/*       console.log("Neuer Inhalt Sections");
      console.log(Calendar.Sections); */

      //übernimmt die neuen Daten in die Tabelle
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

        newItem.name = getItemsArray[i].name;
        newItem.id = getItemsArray[i].id;

        //Zuweisung Anfang/Ende Termin
        //wenn Termin nur ein Tag ist, wird dem End-Datum 23 Stunden zugefügt
        //ansonsten wird für die graphische Darstellung am Anfang eine 0.5h und am Ende -1h
        if(getItemsArray[i].start == getItemsArray[i].end)
        {
          newItem.start = new Date(getItemsArray[i].start);
          newItem.start.setHours(+ 0.5);
          newItem.end = new Date(getItemsArray[i].end);
          newItem.end.setHours(+23);

        } else{
          newItem.start = new Date(getItemsArray[i].start);
          newItem.start.setHours(+ 0.5);
          newItem.end = new Date(getItemsArray[i].end);
          newItem.end.setHours(- 1);
        } 

        //weißt dem Termin die Hintergrundfarbe zu
        //entsprechend der Status-Spalte in der Datenbank
        if(getItemsArray[i].classes === 1)
        {
          newItem.classes = 'item-status-none';
        }
        if(getItemsArray[i].classes === 2)
        {
          newItem.classes = 'item-status-one';
        }
        if(getItemsArray[i].classes === 3)
        {
          newItem.classes = 'item-status-two';
        }

        //newItems Objekt wird dem Array Calendar.Items hinzugefügt
        //jedes Objekt entspricht einem neuen Termin
        Calendar.Items.push(newItem);
      }

/*       console.log("Neuer Inhalt Items");
      console.log(Calendar.Items); */

      TimeScheduler.Init(true);
    }
  };
  xmlhttp.open("GET", "/Homepage/TimeScheduler-master/getItems.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send();
}
getItemsTest();

$(document).ready(Calendar.Init);