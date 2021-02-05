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
if ($_SESSION["permission"] == 1) {
    header("location: /Homepage/skilehrer-termine-uebersicht.php");
}
$session_value = (isset($_SESSION['id'])) ? $_SESSION['id'] : '';
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

    <?php include '../includes/header.php'; ?>

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
                    <?php include '../termine-anlegen-neu.php'; ?>
                </div>
            </div>

            <div class="col-sm-9">
                <div class="content">
                    <div class="calendar">
                    </div>
                    <div class="realtime-info">
                    </div>
                    <!-- Popup Termin bearbeiten -->
                    <div id="myModal" class="modalbox modalbox-itemPopup">
                        <!-- Modal content -->
                        <div class="modalbox-content" id="testme">
                            <span class="close">&times;</span>

                            <form class="content-container" id="formpopup" action="" name="contact">
                                <h2>Termin bearbeiten</h2>
                                <div class="resultpopup"></div>
                                <div class="form-group row search-box live-search-popup">
                                    <label for="skilehrername" class="col-sm-4  col-form-label">Skilehrer:</label>
                                    <div class="col-sm-8 specialFieldFullWidth">
                                        <input type="text" value="" class="form-control" name="skilehrername" id="skilehrernamepopup" autocomplete="off" placeholder="Suche Skilehrer ..." required>
                                        <div class="skilehrerResult liveSearchResultStyle skilehrerResultPopup skilehrerResultNeuTermin"></div>
                                        <div class="skilehrer-id-popup" id="skilehrer-id-popup" data-value="" hidden></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kundenname" class="col-sm-4  col-form-label">Kunde</label>
                                    <input type="text" name="kundenname" id="kundennamepopup" class="form-control col-sm-8" required>
                                </div>

                                <div class="form-group row">
                                    <label for="abholort" class="col-sm-4  col-form-label">Abholort</label>
                                    <input type="text" class="form-control col-sm-8" name="abholort" id="abholortpopup" minlength="1" required>
                                </div>

                                <div class="form-group row">
                                    <label for="beginn" class="col-sm-4  col-form-label">Beginn</label>
                                    <div class="col-sm-8 specialFieldFullWidth">
                                        <input type="date" class="form-control" name="beginn" id="datumbeginnpopup" required>
                                        <div id="livesearch"></div>
                                        <div id="livesearchbeginn"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ende" class="col-sm-4  col-form-label">Ende</label>
                                    <div class="col-sm-8 specialFieldFullWidth">
                                        <input type="date" class="form-control" name="ende" id="datumendepopup" value="" required>
                                        <div id="livesearch"></div>
                                        <div id="livesearchende"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <!-- Dropdown Status ändern -->
                                    <label for="statuspopup" class="col-sm-4 col-form-label">Status</label>
                                    <select class="form-control col-sm-8" name="statuspopup" id="statuspopup" placeholder="Bitte wählen">
                                        <option value="item-status-none">OK</option>
                                        <option value="item-status-one">Rückmeldung</option>
                                        <option value="item-status-two">Abgelehnt</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <button type="submit" name="submit" class="btn btn-primary" id="submit_btnpopup" value="Send">Speichern</button>
                                </div>
                                <div class="row">
                                    <button id="deleteTermin" class="btn btn-primary deleteTermin">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/Homepage/termine-anlegen-process/CreateTermineDbEntry.js" crossorigin="anonymous"></script>
    <script src="/Homepage/termine-anlegen-process/skilehrer-live-search.js" crossorigin="anonymous"></script>
    <script src="/Homepage/termine-anlegen-process/validate-live-date.js" crossorigin="anonymous"></script>

</body>

</html>