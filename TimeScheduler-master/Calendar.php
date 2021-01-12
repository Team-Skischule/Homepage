<!DOCTYPE html>

<html>
    <head runat="server">
    
        <title>Kalender</title>
        <link href="css/jquery-ui.css" rel="stylesheet" />
        <link href="css/jquery.ui.theme.css" rel="stylesheet" />

        <link href="css/timelineScheduler.css" rel="stylesheet" />
        <link href="css/timelineScheduler.styling.css" rel="stylesheet" />
        <link href="css/calendar.css" rel="stylesheet" />

        <script src="js/moment.min.js"></script>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery-ui-1.10.2.min.js"></script>
    
        <script src="js/timelineScheduler.js"></script>
        <script src="js/calendar.js"></script>
         <?php include '../includes/header.php';?> 

    </head>
    <body>
        <?php include '../includes/navigation.php';?>
        <div class="content">
            <h1>Skilehrer Tabelle</h1>
            <p>Hier können die Termine und Skilehrer Verwaltet werden</p>
            <div>
                <button type="button" class="btn btn-outline-primary">Neuen Termin Anlegen</button>
                <button type="button" class="btn btn-outline-primary">Neuen Skilehrer Anlegen</button>
            </div>
            <div class="calendar">

            </div>
            <div class="realtime-info">
                
            </div>
        </div>
        
    </body>
    
    
</html>
