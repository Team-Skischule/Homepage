<?php

    include "../config.php";

    $id = $_POST['id'];
    $stmt = $link->prepare("Select firstname, lastname, mobile, email, birthdate, skilevel, snowboardlevel, comment, id From skilehrer where id = ?");

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $outp = $result->fetch_all(MYSQLI_ASSOC);

   /*  $outp = array();
    while ($row = $result -> fetch_assoc()){
        array_push($outp, array("firstname" => $row['firstname'], 
                                "lastname" => $row['lastname'], 
                                "mobile" => $row['mobile']));
    } */
    echo json_encode($outp);
  

?>