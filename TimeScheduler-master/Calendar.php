<?php
session_start();

/* echo "<h3> PHP List All Session Variables</h3>";
foreach ($_SESSION as $key => $val)
  echo $key . " " . $val . "<br/>"; */
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: /Homepage/login.php");
  exit;
}
if ($_SESSION["permission"] == 1){
    header("location: /Homepage/skilehrer-termine-uebersicht.php");
}
$session_value=(isset($_SESSION['id']))?$_SESSION['id']:'';
?>
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
        <div class="container-fluid">
            <div class="row top-row">
                <div class="col-sm-3">
                    <div class="btn btn-mitarbeiter">
                        <a class="nav-link" href="/Homepage/skilehrer-anlegen.php">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h1>Skilehrer Tabelle</h1>
                    <p>Hier können die Termine und Skilehrer Verwaltet werden</p>
                </div>
                <div class="col-sm-3">
                    <div class="btn btn-logout">
                        <a class="nav-link" href="/Homepage/logout.php">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-3 sidebar">
                    <div class="sidebar-container">
                        <?php include '../termine-anlegen-neu.php';?>
                    </div>
                </div>
               
                <div class="col-sm-9">
                    <div class="content">
                        <div class="calendar">
                        </div>
                        <div class="realtime-info">
                        </div>
                        <div id="myModal" class="modalbox">
                        <!-- Modal content -->
                            <div class="modalbox-content">
                                <span class="close">&times;</span>
                                <p>insert text here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="/Homepage/termine-anlegen-process/CreateTermineDbEntry.js" 
            crossorigin="anonymous"></script>
        <script src="/Homepage/termine-anlegen-process/skilehrer-live-search.js" 
            crossorigin="anonymous"></script>
        <script src="/Homepage/termine-anlegen-process/validate-live-date.js" 
            crossorigin="anonymous"></script>
      
    </body> 
</html>
