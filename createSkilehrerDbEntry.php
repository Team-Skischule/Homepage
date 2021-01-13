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
$firstName = $lastName = $mobile = $email = $street = $houseNumber = $zipCode = $city = "";
$birthDate = $levelErr = $comment = $iban = "";
$canSki = $canSnowboard = 0;
$errorMail = $errorMobile = $message ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 


    if (empty($_POST["formVorname"])) {
        $errors["Vorname"] = "Vorname ist erforderlich";
        $validationFailed = true;
    } else {
        $firstName = test_input($_POST["formVorname"]);
    }

    if (empty($_POST["formNachname"])) {
        $errors["Nachname"] = "Nachname ist erforderlich";
        $validationFailed = true;
    } else {
        $lastName = test_input($_POST["formNachname"]);
    }

    if (empty($_POST["formEmail"])) {
        $errors["Email"] = "Email ist erforderlich";
        $validationFailed = true;
    } else {
        $email = test_input($_POST["formEmail"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["Email"] = "Ungültige Email Adresse";
            $validationFailed = true;
        }
    }

    if (empty($_POST["formMobil"])) {
        $errors["Mobilnummer"] = "Mobilnummer ist erforderlich";
        $validationFailed = true;
    } else {
        $mobile = test_input($_POST["formMobil"]);
        // check if mobile number is valid
        if (!preg_match("/\+[0-9]{10}+/s", $mobile)) {
            $errors["Mobilnummer"] = "Ungültige Mobilnummer";
            $validationFailed = true;
        }
    }

    if (empty($_POST["formGeburtsdatum"])) {
        $errors["Geburtsdatum"] = "Geburtsdatum ist erforderlich";
        $validationFailed = true;
    } else {
        $birthDate = test_input($_POST["formGeburtsdatum"]);
    }
    
    if (empty($_POST["formSki"])) {
        $canSki = 0;
    } else {
        $canSki = 1;
    }

    if (empty($_POST["formSnowboard"])) {
        $canSnowboard = 0;
    } else {
        $canSnowboard = 1;
    }

    if (empty($_POST["formKommentar"])) {
        $comment = "";
    } else {
        $comment = test_input($_POST["formKommentar"]);
    }

    if (empty($_POST["formLevel"])) {
        $errors["Level"] = "Level ist erforderlich";
        $validationFailed = true;
    } else {
        $level = (int)test_input($_POST["formLevel"]);
    }
    date_default_timezone_set('Europe/Vienna');

    

    if ($validationFailed){
        foreach($errors as $x => $value) {
            $msg =  $x . " = " . $value;
            error_log(date("Y-F-j, G:i").": in CreateSkilehrerDbEntry.php: ".$msg."\n", 3,  "errors-log.log"); 
            echo "Validierungsfehler: " . $msg;
        }
    } // Validation OK
    else {
        include "config.php";
        /* -- Check if E-Mail or Mobile-Telefonnummer already exists in database:
            1. get all E-Mail from database
            2. check if entered email is in it
                2.a if yes return error
                2.b if no safe to database and return angelegt
        */
        
        // 1.
        $emailInDB = "SELECT email, mobile From skilehrer where (email='$email' or mobile='$mobile');";
        $result = mysqli_query($link,$emailInDB); 
        
        // 2a.    
        echo "vor 2.a";
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($email==$row['email']) {
                $errorMail = "E-Mail: " . $row['email'] . " wurde bereits verwendet!";
                echo $errorMail; 
            }
            if ($mobile==$row['mobile']) {
                $errorMobile = "Mobile: " . $row['mobile'] . " wurde bereits verwendet!";
                echo $errorMobile;
            } 
            //header("Location: http://localhost/Homepage/skilehrer-anlegen.php");
        }

        // 2.b
        else {
            $stmt = $link->prepare("INSERT INTO skilehrer (firstName, lastName, mobile, email, level, canSki, canSnowboard, birthDate, comment)
                        VALUES (?,?,?,?,?,?,?,?,?)");
    
            $stmt->bind_param("ssssiiiss", $firstName, $lastName, $mobile, $email, $level, $canSki, $canSnowboard, $birthDate, $comment);
            $stmt->execute();
    
            $stmt->close();
            $link->close();
    
            echo "Skilehrer angelegt";
            $message = "Skilehrer wurde angelegt!";
            //header("Location: http://localhost/Homepage/skilehrer-anlegen.php");
        }
    }
} 
?>