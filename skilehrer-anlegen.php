<!DOCTYPE html>
<html lang="de">

<head>
<?php include 'includes/header.php';?> 
    <title>Skilehrer anlegen</title>

 <!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome-5.15.1/css/all.min.css"> -->
    <link rel="stylesheet" href="style.css"> 

    <script>
        function test(){
            //LoadingSpinner einschalten
           var data = {
               vorname: document.getElementById('formVorname').value
           }
           console.log(data);
           
           //var response = fetch("http://localhost/backend.php", {
           //    method: POST,
           //    body: JSON.stringify(data)
           //});
           //prüfen ob erfolgreich
           //Spinner deaktivieren oder weiterleiten auf andere seite
           //json mit schilehrern
           var liste = document.getElementById('test');
           for(var i = 0; i<10;i++) {
                var text = document.createTextNode("Hallo "+i);
                liste.appendChild(text);
                liste.appendChild(document.createElement('br'));
            }
        } 
    </script>
</head>

<body>

    <?php include 'includes/navigation.php';?>

    <div class="content">
    <form class="content-container" action="api/create.php" method="POST">
        <div class="row">
            <div class="col-md-2">
                <div class="row">
                    <!-- <img src="Profilpic.png" alt="Profilbild" class="mx-auto d-block" width="150"> -->
                </div>
                <div class="form-group row">

                   <!--  <label for="inputProfilbild" class="mx-auto d-block profile-pic-upload">
                        <i class="fas fa-folder-open"></i>
                        <input type="file" id="inputProfilbild" style="display:none">
                  </label> -->
                </div>
            </div>
            <div class="col-md-8">
                <h1>Neuen Skilehrer Anlegen:</h1>
                <div class="form-group row">
                    <label for="formVorname" class="col-sm-3 col-form-label">
                        Vorname
                    </label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="formVorname" id="formVorname">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="formNachname" class="col-sm-3 col-form-label">
                        Nachname
                    </label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="formNachname" id="formNachname">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="formMobil" class="col-sm-3 col-form-label">
                        Mobil
                    </label>

                    <div class="col-sm-9">
                        <input type="tel" class="form-control" name="formMobil" id="formMobil">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="formEmail" class="col-sm-3 col-form-label">
                        Email
                    </label>

                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="formEmail" id="formEmail">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="formGeburtsdatum" class="col-sm-3 col-form-label">
                        Geburtsdatum
                    </label>

                    <div class="col-sm-9">
                        <input type="date" class="form-control" name="formGeburtsdatum" id="formGeburtsdatum">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="formStrasse" class="col-sm-3 col-form-label">
                        Straße
                    </label>
                    <div class="col-8 col-sm-7">
                        <input type="text" class="form-control" name="formStrasse" id="formStrasse">
                    </div>
                    <div class="col-4 col-sm-2">
                        <input type="text" class="form-control" placeholder="Nr." name="formNr" id="formNr">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="formWohnort" class="col-sm-3 col-form-label">
                        Wohnort
                    </label>

                    <div class="col-4 col-sm-2">
                        <input type="text" class="form-control" placeholder="PLZ" name="formPLZ" id="formPLZ">
                    </div>
                    <div class="col-8 col-sm-7">
                        <input type="text" class="form-control" name="formWohnort" id="formWohnort">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                        Disziplin
                    </div>
                    <div class="col-sm-9">
                        <div class="form-check">
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
                </div>
                <div class="form-group row">
                    <label for="formLevel" class="col-sm-3 col-form-label">
                        Level
                    </label>

                    <div class="col-sm-9">
                        <select class="form-control" name="formLevel" id="formLevel">
                            <option value="1">Level-1</option>
                            <option value="2">Level-2</option>
                            <option value="3">Level-3</option>
                            <option value="4">Level-4</option>
                            <option value="5">Level-5</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="formIBAN" class="col-sm-3 col-form-label">
                        IBAN
                    </label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="formIBAN" id="formIBAN">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="formKommentar" class="col-sm-3 col-form-label">
                        Kommentar
                    </label>

                    <div class="col-sm-9">
                        <textarea id="formKommentar" name="formKommentar" class="form-control" rows="5">
                    </textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">Speichern</button>
                        <!-- <button type="button" class="btn btn-primary" onclick="test()">Speichern</button> -->
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