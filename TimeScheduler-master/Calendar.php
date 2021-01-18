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
                    <!-- https://www.youtube.com/watch?v=sn2hRCOR-Qg -->
                    <div class="tabs">
                        <div class="tab-header">
                            <div class="active">
                                <i class="far fa-calendar-plus">Termine neu</i>
                            </div>
                            <div >
                                <i class="far fa-calendar-minus">Termine bearbeiten</i>
                            </div>
                            <div>
                                <i class="fa fa-users">Mitarbeiter Neu</i>
                            </div>
                            <div>
                                <i class="fa fa-bar-user-edit">Mitarbeiter bearbeiten</i>
                            </div>
                            <div>
                                <i class="fa fa-bar-envelop">Contact</i>
                            </div>
                        </div>
                        <div class="tab-indicator"></div>
                        <div class="tab-content">
                            <div class="active">
                                <i class="fa fa-code">Code</i>
                                <h2>this is code section</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quperiores sint ducimus eum nam natus cupiditate magni quas nemo! Fugit.</p>
                            </div>
                            <div>
                                <i class="fa fa-pencil-square">about</i>
                                <h2>this is about section</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quperiores sint ducimus eum nam natus cupiditate magni quas nemo! Fugit.</p>
                            </div>
                            <div>
                                <i class="fa fa-chart">Service</i>
                                <h2>this is chart section</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quperiores sint ducimus eum nam natus cupiditate magni quas nemo! Fugit.</p>
                            </div>
                            <div>
                                <i class="fa fa-envelope">Contact</i>
                                <h2>this is envelop section</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quperiores sint ducimus eum nam natus cupiditate magni quas nemo! Fugit.</p>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-sm-9">
                    <div class="content">
                        <!-- <div>
                            <a href="/Homepage/termine-anlegen.php"> <button type="button" class="btn btn-outline-primary">Neuen Termin Anlegen</button></a> 
                            <a href="/Homepage/skilehrer-anlegen.php"> <button type="button" class="btn btn-outline-primary">Neuen Skilehrer Anlegen</button></a> 
                        </div> -->
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
            console.log('wird geladen')
            function _class(name){
            return document.getElementsByClassName(name);
            }

            let tabPanes = _class("tab-header")[0].getElementsByTagName("div");

            for(let i=0;i<tabPanes.length;i++){
            tabPanes[i].addEventListener("click",function(){
                _class("tab-header")[0].getElementsByClassName("active")[0].classList.remove("active");
                tabPanes[i].classList.add("active");
                
                _class("tab-indicator")[0].style.top = `calc(80px + ${i*50}px)`;
                console.log("i: " + i)
                _class("tab-content")[0].getElementsByClassName("active")[0].classList.remove("active");
                _class("tab-content")[0].getElementsByTagName("div")[i].classList.add("active");
                
            });
            }
        </script>
 
    </body> 
    
</html>
