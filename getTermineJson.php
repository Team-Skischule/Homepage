<?php
    include "config.php";
    header("Content-Type: application/json; charset=UTF-8");

    $stmt = $link->prepare("SELECT id, skilehrerid, status, datumBeginn, datumEnde,Datediff(datumEnde, datumBeginn) as timeDiff ,  kundenName, abholort FROM termine;");

    $stmt->execute();
    $result = $stmt->get_result();
    $outp = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($outp);
?>