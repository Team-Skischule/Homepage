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
            <div class="row">
                <div class="col-sm-12">
                    <h1>Skilehrer Tabelle</h1>
                    <p>Hier können die Termine und Skilehrer Verwaltet werden</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <!-- https://getbootstrap.com/docs/4.0/components/navs/ -->
                    <div class="container">
                    <h2>Dynamic Tabs</h2>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                        <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
                        <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                        <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                        <h3>HOME</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                        <h3>Menu 1</h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                        <h3>Menu 2</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                        <h3>Menu 3</h3>
                        <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                        </div>
                    </div>
                    </div>

                    
                </div>
               
                <div class="col-sm-9">
                    <div class="content">
                        <div>
                            <a href="/Homepage/termine-anlegen.php"> <button type="button" class="btn btn-outline-primary">Neuen Termin Anlegen</button></a> 
                            <a href="/Homepage/skilehrer-anlegen.php"> <button type="button" class="btn btn-outline-primary">Neuen Skilehrer Anlegen</button></a> 
                        </div>
                        <div class="calendar">
            
                        </div>
                        <div class="realtime-info">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
    </body> 
    
</html>
