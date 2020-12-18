<?php  
    include "SkilehrerAnlegen/api/dbConfig.php";
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_POST["x"], false);
    // Create connection
    $conn = new mysqli($host, $user, $password, $dbName);
    $stmt = $conn->prepare("UPDATE slidervalue SET value=? WHERE id = '1'");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt->bind_param("s", $obj->value);
    $stmt->execute();
    $conn->close();
    $result = 'OK';
    echo json_encode($result);

?>