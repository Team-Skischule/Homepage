<?php

    $id = $_POST['id'];

    include "config.php";

    $stmt = $link->prepare("Delete from termine where id = ?;");

    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo $stmt->error;
    echo "Termin wurde gelöscht";
    error_log(date("Y-F-j, G:i").": in CreateTerminebEntry.php: ".$stmt->error."\n", 3,  "errors-log.log");
        
    $stmt->close();
    $link->close();

?>