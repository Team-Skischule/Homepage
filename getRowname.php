<?php
    include "config.php";
    header("Content-Type: application/json; charset=UTF-8");

    $stmt = $link->prepare("SELECT id, username as name FROM skischule.users");

    $stmt->execute();
    $result = $stmt->get_result();
    $outp = array();
    while ($row - $result->fetch_assoc()){
        array_push($outp, array("id" -> $row['id'], "name" -> $row['name']));
    }

    echo json_encode($outp);
?>