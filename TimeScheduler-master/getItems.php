<?php
    include "../config.php";
    header("Content-Type: application/json; charset=UTF-8");

    $stmt = $link->prepare("SELECT skilehrerid, kundenname, abholort, datumbeginn, datumende, status, id FROM termine");

    $stmt->execute();
    $result = $stmt->get_result();
/*     $outp = $result->fetch_all(MYSQLI_ASSOC);
 */   

 //sendet JSON als Array
 $outp = array();
    while ($row = $result -> fetch_assoc()){

        //array_push muss noch angepasst werden, start / end
        array_push($outp, array("sectionID" => $row['skilehrerid'], 
                                "kundenname" => $row['kundenname'], 
                                "abholort" => $row['abholort'],
                                "classes" => $row['status'], 
                                "start" => $row['datumbeginn'], 
                                "end" => $row['datumende'],
                                "id" => $row['id']));
    }


    echo json_encode($outp);
?>