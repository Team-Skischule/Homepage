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
            <div class="row ">
                <div class="col-sm-3 sidebar">
                    <div class="sidebar-container">
                        <h2>Termin anlegen</h2>
                        <?php include '../termine-anlegen-neu.php';?>
                    </div>
                    <div class="sidebar-container">
                        <h2>Mitarbeiter anlegen</h2>
                        <?php include '../skilehrer-anlegen-neu.php';?>
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

        <script src="/Homepage/termine-anlegen-process/CreateTermineDbEntry.js" 
            crossorigin="anonymous"></script>
        <script src="/Homepage/termine-anlegen-process/skilehrer-live-search.js" 
            crossorigin="anonymous"></script>
      
    
    </body> 
    
</html>
