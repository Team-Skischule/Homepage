<?php
    include "SkilehrerAnlegen/api/dbConfig.php";
    header("Content-Type: application/json; charset=UTF-8");

    $conn = new mysqli($host, $db_username, $db_password, $db_name);
    $stmt = $conn->prepare("SELECT firstName, lastName, id FROM skilehrer");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $outp = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($outp);
?>