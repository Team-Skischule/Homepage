<!DOCTYPE html>
<html lang="de">

<head>
<?php include 'includes/header.php';?> 
    <title>Skilehrer anlegen</title>

 <!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome-5.15.1/css/all.min.css"> -->
    <link rel="stylesheet" href="style.css"> 

 
</head>

<body>

    <?php include 'includes/navigation.php';?>
    <?php include 'createSkilehrerDbEntry.php';?>
    

    <div class="content">
    <form class="content-container" id="form" action="createSkilehrerDbEntry.php" method="POST">
        <div class="row">
            <div class="col-md-2">
                <div class="row">  
                </div>
                <div class="form-group row"> 
                </div>
            </div>
            <div class="col-md-8 formularDesign">
                <h1>Neuen Skilehrer Anlegen:</h1>

                <div class="form-group row">
                    <label for="formVorname" class="col-sm-2 col-form-label">
                        Vorname*
                    </label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="formVorname" id="formVorname"  required>
                    </div>
                
                    <label for="formNachname" class="col-sm-2 col-form-label">
                        Nachname*
                    </label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="formNachname" id="formNachname"minlength="1" required>
                    </div>
                </div>
                <!-- Neue Zeile -->
                <div class="form-group row">
                    <label for="formMobil" class="col-sm-2 col-form-label">
                        Telefonnummer*
                    </label>

                    <div class="col-sm-4">
                        <input type="tel" class="form-control" name="formMobil" id="formMobil"  placeholder="+1234567890" required>
                    </div>

                    <label for="formEmail" class="col-sm-2 col-form-label">
                        Email*
                    </label>

                    <div class="col-sm-4">
                        <input type="email" class="form-control" name="formEmail" id="formEmail" placeholder="test@tester.at" required>
                    </div>
                </div>
                <!-- Neue Zeile -->
                <div class="form-group row">
                    <label for="formGeburtsdatum" class="col-sm-2 col-form-label">
                        Geburtsdatum*
                    </label>

                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="formGeburtsdatum" id="formGeburtsdatum" required>
                    </div>
                    <div class="col-sm-1 col-form-label ">
                        Disziplin*
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="formSki" id="formSki">
                            <label class="form-check-label checkbox-label" for="formSki">
                                Ski
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="formSnowboard" id="formSnowboard">
                            <label class="form-check-label checkbox-label" for="formSnowboard">
                                Snowboard
                            </label>
                        </div>
                    </div>
                    <label for="formLevel" class="col-sm-1 col-form-label">
                        Level*
                    </label>

                    <div class="col-sm-2">
                        <select class="form-control" name="formLevel" id="formLevel" placeholder="Bitte wählen">
                            <option value="1">Level-1</option>
                            <option value="2">Level-2</option>
                            <option value="3">Level-3</option>
                            <option value="4">Level-4</option>
                            <option value="5">Level-5</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="formKommentar" class="col-sm-2 col-form-label">
                        Kommentar
                    </label>

                    <div class="col-sm-10">
                        <textarea id="formKommentar" name="formKommentar" class="form-control" rows="5">
                    </textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Speichern</button>
                    </div>
                </div>

            </div>
            <div class="col-md-2">
            </div>
        </div>
    </form>
<div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>


</body>

</html>