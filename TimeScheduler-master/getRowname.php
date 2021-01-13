<?php
    include "config.php";
    header("Content-Type: application/json; charset=UTF-8");

    $stmt = $link->prepare("SELECT id, concat(firstname,' ', lastname) as fullname FROM skischule.skilehrer");

    $stmt->execute();
    $result = $stmt->get_result();
/*     $outp = $result->fetch_all(MYSQLI_ASSOC);
 */   

 //sendet JSON als Array
 $outp = array();
    while ($row = $result -> fetch_assoc()){
        array_push($outp, array("id" => $row['id'], "name" => $row['fullname']));
    }

    echo json_encode($outp);
?>