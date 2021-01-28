<?php

    $start = $_POST['start'];
    $end = $_POST['end'];
    $id = $_POST['id'];

    include "config.php";

    $stmt = $link->prepare("Update termine set datumbeginn = ?, datumende = ? where id = ?");

    $stmt->bind_param("ssi", $start, $end, $id);
    $stmt->execute();
    echo $stmt->error;
    echo "Termin wurde angepasst";
    error_log(date("Y-F-j, G:i").": in CreateTerminebEntry.php: ".$stmt->error."\n", 3,  "errors-log.log");
        
    $stmt->close();
    $link->close();

?>