<?php
    include "config.php";
    header("Content-Type: application/json; charset=UTF-8");

    $stmt = $link->prepare("SELECT id, username FROM skischule.users");

    $stmt->execute();
    $result = $stmt->get_result();
/*     $outp = $result->fetch_all(MYSQLI_ASSOC);
 */   
 $outp = array();
    while ($row = $result -> fetch_assoc()){
        array_push($outp, array("id" => $row['id'], "name" => $row['username']));
    }

    echo json_encode($outp);
?>