<?php 
/* Diese Funktion wird aufgerufen wenn auf Termin absagen (X) oder Rückmeldung (?) geklickt wird. Der Status ändert sich auf 2 oder 3 */
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// define variables and set to empty values
$terminid = "";
$newTerminStatus = "";
$validationFailed = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["terminid"])) {
        $errors["terminid"] = "terminid ist erforderlich";
        $validationFailed = true;
    } else {
        $terminid = test_input($_POST["terminid"]);
    }

    if (empty($_POST["newTerminStatus"])) {
        $errors["newTerminStatus"] = "newTerminStatus ist erforderlich";
        $validationFailed = true;
    } else {
        $newTerminStatus = test_input($_POST["newTerminStatus"]);
    }

    date_default_timezone_set('Europe/Vienna');

    if ($validationFailed){
        foreach($errors as $x => $value) {
            $msg =  $x . " = " . $value;
            error_log(date("Y-F-j, G:i").": in Termin-status-update.php: ".$msg."\n", 3,  "errors-log.log"); 
            echo "Termin Status nicht geändert. Fehler in error-log";
        }
    } else {

        include "../config.php";
        
        //insert into database
        $stmt = $link->prepare("UPDATE termine SET status = ?  where id = ?");

        $stmt->bind_param("ii" , $newTerminStatus,  $terminid );
        $stmt->execute();
        echo $stmt->error;
        echo "Info an Administation gesendet";
            
        $stmt->close();
        $link->close();
    }  
}
?>