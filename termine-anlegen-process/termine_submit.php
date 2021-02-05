<?php 

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// define variables and set to empty values
$validationFailed = false;
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  /*   if (empty($_POST["skilehrerid"])) {
        $errors["skilehrerid"] = "skilehrerid ist erforderlich";
        $validationFailed = true;
    } else {
        $skilehrerid = test_input($_POST["skilehrerid"]);
    } */
    $skilehrerid = $_POST["skilehrerid"];

    if (empty($_POST["abholort"])) {
        $errors["abholort"] = "abholort ist erforderlich";
        $validationFailed = true;
    } else {
        $abholort = test_input($_POST["abholort"]);
    }

    if (empty($_POST["kundenname"])) {
        $errors["kundenname"] = "kundenname ist erforderlich";
        $validationFailed = true;
    } else {
        $kundenname = test_input($_POST["kundenname"]);
    }
    
    if (empty($_POST["datumBeginn"])) {
        $errors["datumBeginn"] = "datumBeginn ist erforderlich";
        $validationFailed = true;
    } else {
        $datumBeginn = test_input($_POST["datumBeginn"]);
    }

    if (empty($_POST["datumEnde"])) {
        $errors["datumEnde"] = "datumEnde ist erforderlich";
        $validationFailed = true;
    } else {
        $datumEnde = test_input($_POST["datumEnde"]);
    }

    date_default_timezone_set('Europe/Vienna');

    if ($validationFailed){
        foreach($errors as $x => $value) {
            $msg =  $x . " = " . $value;
            error_log(date("Y-F-j, G:i").": in termine_submit.php: ".$msg."\n", 3,  "errors-log.log"); 
        }
    } else {

        include "../config.php";
        
        //insert into database
        $stmt = $link->prepare("
            INSERT INTO termine (skilehrerid, abholort, kundenname, datumBeginn, datumEnde)
            VALUES (?,?,?,?,?)");

        $stmt->bind_param("issss", $skilehrerid, $abholort, $kundenname, $datumBeginn, $datumEnde);
        $stmt->execute();
        echo $stmt->error;
        echo "Termin für Kunde \"" . $kundenname . "\" wurde angelegt.";
            
        $stmt->close();
        $link->close();
    }  
}
?>