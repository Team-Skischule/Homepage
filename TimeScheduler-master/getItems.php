<?php
    include "config.php";
    header("Content-Type: application/json; charset=UTF-8");

    $stmt = $link->prepare("SELECT skilehrerid, kundenname, datumbeginn, datumende FROM skischule.termine");

    $stmt->execute();
    $result = $stmt->get_result();
/*     $outp = $result->fetch_all(MYSQLI_ASSOC);
 */   

 //sendet JSON als Array
 $outp = array();
    while ($row = $result -> fetch_assoc()){

        //array_push muss noch angepasst werden, start / end
        array_push($outp, array("sectionID" => $row['skilehrerid'], 
                                "name" => $row['kundenname'], 
                                "classes" => ['item-status-one'], 
                                "start" => $row['datumbeginn'], 
                                "end" => $row['datumende']));
    }


    echo json_encode($outp);
?>