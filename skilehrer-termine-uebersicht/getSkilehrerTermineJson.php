<?php
/* ---
    Betrifft: Skilehrer Übersichtsseite
        Für den jeweils eingeloggten Skilehrer 
        wird anhand seiner skilehrerId die zugehörigen Termine geholt.
--- */

    include "../config.php";

    header("Content-Type: application/json; charset=UTF-8");
    
    // Prepare a select statement
    $sql = "SELECT * FROM skischule.termine where skilehrerid = ? order by datumBeginn";

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = $_REQUEST["id"];

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            $rowsJson = array();
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                while ($row = $result -> fetch_assoc()){    
                    array_push($rowsJson, array(
                        "Beginn" => $row['datumBeginn'],
                        "Ende" => $row['datumEnde'],
                        "Kunde" => $row['kundenname'],
                        "Abholort" => $row['abholort'],
                        "terminId" => $row['id']
                    ));
                }
                echo json_encode($rowsJson);
            } else{
                echo "Keine Termine eingetragen";
            }
        } else{
            echo "ERROR: Could not be executed $sql. " . mysqli_error($link);
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
?>