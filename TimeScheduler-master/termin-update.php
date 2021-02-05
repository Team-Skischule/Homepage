<?php
        include "../config.php";

$name = $_POST['name'];
$ort = $_POST['ort'];
$start = $_POST['start'];
$end = $_POST['end'];
$id = $_POST['id'];
$skilehrerid = $_POST['skilehrerid'];
$status = $_POST['status'];


$stmt = $link->prepare("Update termine Set kundenname = ?, abholort = ?, datumbeginn = ?, datumende = ?, skilehrerid = ?, status = ? Where id = ?");

                $stmt->bind_param("ssssiii", $name, $ort, $start, $end, $skilehrerid, $status, $id);
                $stmt->execute();

                //echo "Skilehrer: ".$firstname." ".$lastname." wurde angelegt";
                  echo "Termin wurde geändert";  
                $stmt->close();
                $link->close();
?>