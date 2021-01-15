<!DOCTYPE html>
<html lang="de">

<head>
<?php include 'includes/header.php';?> 
    <title>Skilehrer anlegen</title>
    <link rel="stylesheet" href="style.css"> 
</head>

<body>
    <?php include 'includes/navigation.php';?>
    
    <div class="content">
        <div id="contact_form">
                <div class="row">
                    <div class="col-md-2">
                        <div class="row">  
                        <!-- leere Spalte -->
                        </div>
                    </div>
                    <div class="col-md-8 formularDesign">
                    <form class="content-container" id="form" action="" name="contact" >
                        <h1>Neuen Termine Anlegen:</h1>
                        <div class="result"></div>
                        <div class="form-group row search-box">
                            <!-- <label for="skilehrerid" class="col-sm-2 col-form-label">SkilehrerID* </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="skilehrerid" id="skilehrerid"  required>
                            </div> -->

                            <label for="skilehrername" class="col-sm-2 col-form-label">Skilehrer* </label>
                            <div class="col-sm-4">
                                <input type="text" value="" class="form-control" name="skilehrername" id="skilehrername" autocomplete="off" placeholder="Suche Skilehrer ..." required>
                                <div class="skilehrerResult liveSearchResultStyle"></div>
                                <div id="skilehrerid"></div>
                            </div>
                        </div>

                        <!-- Neue Zeile -->
                        <div class="form-group row">
                            <label for="abholort" class="col-sm-2 col-form-label">Abholort*</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="abholort" id="abholort"minlength="1" required>
                            </div>
                            
                            <label for="kundenname" class="col-sm-2 col-form-label">Kunde*</label> 
                            <div class="col-sm-4">
                                <input type="text" name="kundenname" id="kundenname" class="form-control"  required>
                            </div>
                        </div>

                        <!-- Neue Zeile -->
                        <div class="form-group row">
                            <label for="beginn" class="col-sm-2 col-form-label">Beginn*</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="beginn" id="beginn" required>
                            </div>
                            
                            <label for="ende" class="col-sm-2 col-form-label">Ende*</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="ende" id="ende" required>
                            </div> 
                        </div>    

                        <!-- Neue Zeile -->
                        <div class="row">
                            <div class="col-sm-12"> 
                                <button type="submit" name="submit" class="btn btn-primary"  id="submit_btn" value="Send">Speichern</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-2">
                    <!-- leere Spalte -->
                    </div>
                </div>
        </div>
    <div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" 
        integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" 
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
    <script src="termine-anlegen-process/CreateTermineDbEntry.js" 
        crossorigin="anonymous"></script>
    <script src="termine-anlegen-process/skilehrer-live-search.js" 
        crossorigin="anonymous"></script>

</body>

</html>