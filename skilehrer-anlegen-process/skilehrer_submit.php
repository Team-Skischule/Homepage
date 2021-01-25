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
$firstName = $lastName = $mobile = $email = "";
$birthDate = $levelErr = $comment = "";
$skiLevel = $snowboardLevel = 0;
$errorMail = $errorMobile = $message ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["firstName"])) {
        $errors["Vorname"] = "Vorname ist erforderlich";
        $validationFailed = true;
    } else {
        $firstName = test_input($_POST["firstName"]);
    }

    if (empty($_POST["lastName"])) {
        $errors["Nachname"] = "Nachname ist erforderlich";
        $validationFailed = true;
    } else {
        $lastName = test_input($_POST["lastName"]);
    }

    if (empty($_POST["email"])) {
        $errors["Email"] = "Email ist erforderlich";
        $validationFailed = true;
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["Email"] = "Ungültige Email Adresse";
            $validationFailed = true;
        }
    }

    if (empty($_POST["mobile"])) {
        $errors["Mobilnummer"] = "Mobilnummer ist erforderlich";
        $validationFailed = true;
    } else {
        $mobile = test_input($_POST["mobile"]);
    }

    if (empty($_POST["birthDate"])) {
        $errors["Geburtsdatum"] = "Geburtsdatum ist erforderlich";
        $validationFailed = true;
    } else {
        $birthDate = test_input($_POST["birthDate"]);
    }
    
    if (empty($_POST["skiLevel"])) {
        $skiLevel = 0;
    } else {
        $skiLevel = test_input($_POST["skiLevel"]);
    }

    if (empty($_POST["snowboardLevel"])) {
        $snowboardLevel = 0;
    } else {
        $snowboardLevel = test_input($_POST["snowboardLevel"]);
    }

    if (empty($_POST["comment"])) {
        $comment = "";
    } else {
        $comment = test_input($_POST["comment"]);
    }

    date_default_timezone_set('Europe/Vienna');

    

    if ($validationFailed){
        foreach($errors as $x => $value) {
            $msg =  $x . " = " . $value;
            echo ("");
            echo nl2br ($msg."\n");
            error_log(date("Y-F-j, G:i").": in CreateSkilehrerDbEntry.php: ".$msg."\n", 3,  "errors-log.log"); 
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
        
        // 1.
        $emailInDB = "SELECT email, mobile From skilehrer where (email='$email' or mobile='$mobile');";
        $result = mysqli_query($link,$emailInDB); 
        
        // 2a.    
        
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($email==$row['email']) {
                $errorMail = "<li>E-Mail: " . $row['email'] . " wurde bereits verwendet!". "</li>";
                echo $errorMail; 
            }
            if ($mobile==$row['mobile']) {
                $errorMobile = "<li>Mobile: " . $row['mobile'] . " wurde bereits verwendet!</li>" ;
                echo $errorMobile;
            } 
        }

        // 2.b
        else {
        //insert into database
                $stmt = $link->prepare("
                    INSERT INTO skilehrer (firstName, lastName, mobile, email, skiLevel, snowboardLevel, birthDate, comment)
                    VALUES (?,?,?,?,?,?,?,?)");

                $stmt->bind_param("ssssiiss", $firstName, $lastName, $mobile, $email, $skiLevel, $snowboardLevel, $birthDate, $comment);
                $stmt->execute();

                echo "Skilehrer: ".$firstName." ".$lastName." wurde angelegt";
                    
                $stmt->close();
                $link->close();
                
            } 
    }  
}

?>