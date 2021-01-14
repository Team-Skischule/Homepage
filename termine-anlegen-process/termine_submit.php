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
$skilehrerid = $abholort = $kundenname = $beginn = $ende = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["skilehrerid"])) {
        $errors["skilehrerid"] = "skilehrerid ist erforderlich";
        $validationFailed = true;
    } else {
        $skilehrerid = test_input($_POST["skilehrerid"]);
    }

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
            echo ("");
            echo nl2br ($msg."\n");
            error_log(date("Y-F-j, G:i").": in CreateTerminebEntry.php: ".$msg."\n", 3,  "errors-log.log"); 
        }
    } // Validation OK
    else {

        include "../config.php";
        
        /* -- Check if E-Mail or Mobile-Telefonnummer already exists in database:
            1. get all E-Mail from database
            2. check if entered email is in it
                2.a if yes return error
                2.b if no safe to database and return angelegt
        */
        
        // 1. // TODO: Hier müssen die Beginn & End Daten mit der Datenbank abgeglichen werden
       /*  $emailInDB = "SELECT email, mobile From skilehrer where (email='$email' or mobile='$mobile');";
        $result = mysqli_query($link,$emailInDB);  */
        
        // 2a.    
        // TODO: Hier muss eine Fehlermeldung kommen wenn sich das Datum überschneidet
       /*  if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($email==$row['email']) {
                $errorMail = "<li>E-Mail: " . $row['email'] . " wurde bereits verwendet!". "</li>";
                echo $errorMail; 
            }
            if ($mobile==$row['mobile']) {
                $errorMobile = "<li>Mobile: " . $row['mobile'] . " wurde bereits verwendet!</li>" ;
                echo $errorMobile;
            } 
        } */

        // 2.b
        /* else { */
        //insert into database
                $stmt = $link->prepare("
                    INSERT INTO skischule.termine (skilehrerid, abholort, kundenname, datumBeginn, datumEnde)
                    VALUES (?,?,?,?,?)");

                $stmt->bind_param("issss", $skilehrerid, $abholort, $kundenname, $datumBeginn, $datumEnde);
                $stmt->execute();
                echo $stmt->error;
                echo "Termin für: ".$skilehrerid." wurde angelegt";
                error_log(date("Y-F-j, G:i").": in CreateTerminebEntry.php: ".$stmt->error."\n", 3,  "errors-log.log");
                    
                $stmt->close();
                $link->close();
                
            /* }  */
    }  
}

?>