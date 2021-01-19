

<!DOCTYPE html>
<html lang="de">

<head>
<?php include 'includes/header.php';?> 
    <title>Skilehrer anlegen</title>

    <link rel="stylesheet" href="style.css"> 

 
</head>

<body>
    <div class="container-fluid">
        <div class="row top-row">
            <div class="col-sm-3">
                <div class="btn btn-mitarbeiter">
                    <a class="nav-link" href="/Homepage/TimeScheduler-master/calendar.php">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <h1>Skilehrer verwalten</h1>
                <p>Hier können die neue Skilehrer angelegt und ihre Daten verwaltet werden.</p>
            </div>
            <div class="col-sm-3">
                <div class="btn btn-logout">
                    <a class="nav-link" href="/Homepage/logout.php">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <!-- leere Spalte -->
            </div>

            <div class="col-md-4 form-column">
                <form class="content-container" id="form" action="" name="contact" >
                    <h2>Termin anlegen</h2>
                    <div class="result">  </div>
                    
                    <div class="form-group row">
                        <label for="formVorname" class="col-sm-4 col-form-label">Vorname* </label>
                        <input type="text" class="form-control col-sm-8" name="formVorname" id="formVorname"  required>
                    </div>
                        
                    <div class="form-group row">
                        <label for="formNachname" class="col-sm-4 col-form-label">Nachname*</label>
                        <input type="text" class="form-control col-sm-8" name="formNachname" id="formNachname"minlength="1" required>
                    </div>
                    
                    <div class="form-group row">
                        <label for="formMobil" class="col-sm-4 col-form-label">Telefon*</label> 
                        <input type="tel" name="phone" id="phone" class="form-control col-sm-8"  placeholder="+1234567890" required>
                    </div>
                    
                    <div class="form-group row">
                        <label for="formEmail" class="col-sm-4 col-form-label">Email*</label>
                        <input type="email" class="form-control col-sm-8" name="formEmail" id="formEmail" placeholder="test@tester.at" required>
                    </div>
                    
                    <div class="form-group row">
                        <label for="formGeburtsdatum" class="col-sm-4 col-form-label">Geburtsdatum*</label>
                        <input type="date" class="form-control col-sm-8" name="formGeburtsdatum" id="formGeburtsdatum" required>
                    </div>
                    
                    <div class="form-group row">
                        <label for="formLevel" class="col-sm-4 col-form-label">Level* </label>
                            <select class="form-control col-sm-8" name="formLevel" id="formLevel" placeholder="Bitte wählen">
                                <option value="1">Level-1</option>
                                <option value="2">Level-2</option>
                                <option value="3">Level-3</option>
                                <option value="4">Level-4</option>
                                <option value="5">Level-5</option>
                            </select>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4 col-form-label ">Disziplin*</div>
                        <div class="col-sm-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="formSki" id="formSki">
                                <label class="form-check-label checkbox-label" for="formSki">Ski</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="formSnowboard" id="formSnowboard">
                                <label class="form-check-label checkbox-label" for="formSnowboard">Snowboard</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="formKommentar" class="col-sm-4 col-form-label">Kommentar</label>
                        <div class="col-sm-8">
                            <textarea id="formKommentar" name="formKommentar" class="form-control" rows="3">
                            </textarea>
                        </div>
                    </div>

                    <div class="row">
                            <button type="submit" name="submit" class="btn btn-primary"  id="submit_btn" value="Send">Speichern</button>
                    </div>
                </form>
            </div>

            <div class="col-md-4 form-column">
            <form class="content-container" id="form" action="" name="contact" >
                <h2>Mitarbeiter bearbeiten formular</h2>
            </form>
            </div>
            
            <div class="col-md-2">
            <!-- leere Spalte -->
            </div>
        </div>
    </div>


   <!--  <script src="https://code.jquery.com/jquery-3.5.1.min.js" 
        integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" 
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script> -->
    <script src="skilehrer-anlegen-process/CreateSkilehrerDbEntry.js" 
        crossorigin="anonymous"></script>

</body>

</html>