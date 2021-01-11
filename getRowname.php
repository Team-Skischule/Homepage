<?php
    include "config.php";
    header("Content-Type: application/json; charset=UTF-8");

    $stmt = $link->prepare("SELECT id, username as name FROM skischule.users");

    $stmt->execute();
    $result = $stmt->get_result();
    $outp = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($outp);
?>