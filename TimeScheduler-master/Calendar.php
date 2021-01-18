<!DOCTYPE html>

<html>
    <head runat="server">
    
        <title>Kalender</title>
        <link href="css/jquery-ui.css" rel="stylesheet" />
        <link href="css/jquery.ui.theme.css" rel="stylesheet" />

        <link href="css/timelineScheduler.css" rel="stylesheet" />
        <link href="css/timelineScheduler.styling.css" rel="stylesheet" />
        <link href="css/calendar.css" rel="stylesheet" />
        <link rel="stylesheet" href="../style.css" />

        <script src="js/moment.min.js"></script>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery-ui-1.10.2.min.js"></script>
    
        <script src="js/timelineScheduler.js"></script>
        <script src="js/calendar.js"></script>

         <?php include '../includes/header.php';?> 

    </head>
    <body>
    <!-- php include '../includes/navigation.php';?> -->
        <div class="container-fluid">
                <div class="col-sm-12 top-row">
                    <h1>Skilehrer Tabelle</h1>
                    <p>Hier können die Termine und Skilehrer Verwaltet werden</p>
                </div>
            <div class="row">
                <div class="col-sm-3">
                <div class="result">  </div>
                    <div class="tabs">
                        <div class="tab-header">
                            <!-- https://www.sitepoint.com/community/t/same-tab-after-page-refresh/39684/4 -->
                            <div class="tab">
                                <a href="?tab=newDate" name="newDate">
                                    <i class="tablinks fa fa-calendar-plus-o" onclick="openTab(event, 'newDate')" id="defaultOpen" ><p>neu</p></i>
                                </a> 
                                <a href="?tab=editDate" name="editDate">
                                    <i class="tablinks fa fa-calendar-minus-o" onclick="openTab(event, 'editDate')"href="?tab=editDate"><p>edit</p></i>
                                </a> 
                                <a href="?tab=newSkilehrer" name="newSkilehrer">
                                    <i class="tablinks fa fa-user-plus" onclick="openTab(event, 'newSkilehrer')"><p>neu</p></i>
                                </a> 
                                <a href="?tab=editSkilehrer" name="editSkilehrer">
                                    <i class="tablinks fa fa-users" onclick="openTab(event, 'editSkilehrer')"><p>edit</p></i>
                                </a> 
                            </div>
                        </div>
                        <div class="tab-content">
                            <div id="newDate" class="tabcontent">
                                <i class="fa fa-calendar-plus-o"></i>
                                <h2>Neuen Termin anlegen</h2>
                                <?php include '../termine-anlegen-neu.php';?>
                            </div>

                            <div id="editDate" class="tabcontent">
                                <i class="fa fa-calendar-minus-o"></i>
                                <h2>Termin bearbeiten</h2>
                            </div>

                            <div id="newSkilehrer" class="tabcontent">
                                <i class="fa fa-user-plus"></i>
                                <h2>Mitarbeiter anlegen</h2>
                                <?php include '../skilehrer-anlegen-neu.php';?>
                            </div>

                            <div id="editSkilehrer" class="tabcontent">
                                <i class="fa fa-users"></i>
                                <h2>Mitarbeiter bearbeiten</h2>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-sm-9">
                    <div class="content">
                        <div class="calendar">
                        </div>
                        <div class="realtime-info">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Tab Mechanismus TODO: noch in anderes js.file verschieben -->
        <script>

            function getParameterByName(name) {
                name = name.replace(/[\\[]/, "\\\\[").replace(/[\\]]/, "\\\\]");
                var regex = new RegExp("[\\\\?&]" + name + "=([^&#]*)"),
                    results = regex.exec(location.search);
                    return results == null ? "" : decodeURIComponent(results[1].replace(/\\+/g, " "));
                }
                
            var tab = getParameterByName('tab');
                
            if(tab) {
                // open same tab
                console.log('tab: ' + tab)
                var y = document.getElementsByName(tab)[0].children;
                // TODO:
                console.log('y.value: ' +y[0].classList.value );
                console.log('y.value: ' +y[0].classList.value );
                function clickTab() {
                    document.getElementsByClassName(y[0].classList.value).click()
                };
                clickTab();
            } else {
                // Get the element with id="defaultOpen" and click on it
               document.getElementById("defaultOpen").click();
            }

            /* var activeTab = document.getElementsByClassName("active");
            if (sessionStorage.getItem("autosave")) {
                // Den Inhalt des Testfeldes aus dem sessionStorage wiederherstellen
                activeTab.value = sessionStorage.getItem("autosave");
                console.log('activeTab: ' + activeTab.value);
            } else {
                console.log('smonthing')
                // Get the element with id="defaultOpen" and click on it
               document.getElementById("defaultOpen").click();
            } */


            

            // Click Function
            function openTab(evt, tabID) {
                var i, tabcontent, tablinks;
                // bei klick auf Tab wird dieser als active Tab in sessionStorage gespeichert:
                /* sessionStorage = document.getElementsByClassName("active");
                console.log('activeTab: ' + activeTab) */

                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(tabID).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>
        <script src="/Homepage/termine-anlegen-process/CreateTermineDbEntry.js" 
            crossorigin="anonymous"></script>
        <script src="/Homepage/termine-anlegen-process/skilehrer-live-search.js" 
            crossorigin="anonymous"></script>
      
    
    </body> 
    
</html>
