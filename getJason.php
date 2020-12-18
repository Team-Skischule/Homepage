<?php
    include "SkilehrerAnlegen/api/dbConfig.php";
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_GET["x"], false);

    $conn = new mysqli($host, $user, $password, $dbName);
    $stmt = $conn->prepare("SELECT value FROM slidervalue WHERE id = 1 LIMIT ?");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt->bind_param("s", $obj->limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $outp = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($outp);
?>

