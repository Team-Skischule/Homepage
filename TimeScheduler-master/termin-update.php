<?php
        include "../config.php";

$name = $_POST['name'];
$ort = $_POST['ort'];
$start = $_POST['start'];
$end = $_POST['end'];
$id = $_POST['id'];
$skilehrerid = $_POST['skilehrerid'];


$stmt = $link->prepare("Update termine Set kundenname = ?, abholort = ?, datumbeginn = ?, datumende = ?, skilehrerid = ? Where id = ?");

                $stmt->bind_param("ssssii", $name, $ort, $start, $end, $skilehrerid, $id);
                $stmt->execute();

                //echo "Skilehrer: ".$firstname." ".$lastname." wurde angelegt";
                  echo "Termin wurde geändert";  
                $stmt->close();
                $link->close();
?>