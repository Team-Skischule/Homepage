<?php

    $start = $_POST['start'];
    $end = $_POST['end'];
    $skilehrerid = $_POST['sectionID'];
    $id = $_POST['id'];

    include "config.php";

    $stmt = $link->prepare("Update termine set datumbeginn = ?, datumende = ?, skilehrerid = ? where id = ?");

    $stmt->bind_param("ssii", $start, $end, $skilehrerid, $id);
    $stmt->execute();
    echo $stmt->error;
    echo "Termin wurde verschoben";
    error_log(date("Y-F-j, G:i").": in CreateTerminebEntry.php: ".$stmt->error."\n", 3,  "errors-log.log");
        
    $stmt->close();
    $link->close();

?>