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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach($_POST as $x => $x_value) {
        echo "Key=" . $x . ", Value=" . $x_value;
        echo "<br>";
    }

    echo "<br>";


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

    if (empty($_POST["formStrasse"])) {
        $errors["Straße"] = "Straße ist erforderlich";
        $validationFailed = true;
    } else {
        $street = test_input($_POST["formStrasse"]);
    }

    if (empty($_POST["formNr"])) {
        $errors["Hausnummer"] = "Hausnummer ist erforderlich";
        $validationFailed = true;
    } else {
        $houseNumber = test_input($_POST["formNr"]);
    }
    
    if (empty($_POST["formPLZ"])) {
        $errors["PLZ"] = "PLZ ist erforderlich";
        $validationFailed = true;
    } else {
        $zipCode = test_input($_POST["formPLZ"]);
    }

    if (empty($_POST["formWohnort"])) {
        $errors["Wohnort"] = "Wohnort ist erforderlich";
        $validationFailed = true;
    } else {
        $city = test_input($_POST["formWohnort"]);
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
        $errors["Mobilnummer"] = "Mobilnummer ist erforlderlich";
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
        $errors["Geburtsdatum"] = "Geburtsdatum ist erforlderlich";
        $validationFailed = true;
    } else {
        // $birthDate = date_parse(test_input($_POST["formGeburtsdatum"]));
        $birthDate = test_input($_POST["formGeburtsdatum"]);
    }

    if (empty($_POST["formIBAN"])) {
        $errors["IBAN"] = "IBAN ist erforlderlich";
        $validationFailed = true;
    } else {
        $iban = test_input($_POST["formIBAN"]);
        // check if IBAN is valid
        if (!preg_match("/^[A-Z]{2}[0-9]{2}[A-Z0-9]{1,30}$/", $iban)) {
            $errors["IBAN"] = "Ungültiger IBAN";
            $validationFailed = true;
        }
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

    if ($validationFailed){
        echo "Validierungsfehler:<br>";
        echo "<ul>";
        foreach($errors as $x => $value) {
            echo "<li>" . $x . " = " . $value . "</li>";
        }
        echo "</ul>";
    } else {
        include "config.php";


        $stmt = $link->prepare("INSERT INTO skilehrer (firstName, lastName, mobile, email, street, houseNumber, zipCode, city, level, canSki, canSnowboard, iban, birthDate, comment)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param("ssssssssiiisss", $firstName, $lastName, $mobile, $email, $street, $houseNumber, $zipCode, $city, $level, $canSki, $canSnowboard, $iban, $birthDate, $comment);
        $stmt->execute();

        $stmt->close();
        $link->close();

        echo "Skilehrer wurde angelegt!";
    }
} else {
    echo "Nur POST Requests werden unterstützt!";
}
?>