<?php
/* ---
    Betrifft: Skilehrer Übersichtsseite
        Für den jeweils eingeloggten Skilehrer 
        wird anhand seiner skilehrerId die zugehörigen Termine geholt.
--- */

    include "../config.php";

    header("Content-Type: application/json; charset=UTF-8");
    
    // Prepare a select statement
    $sql = 
        "SELECT id, skilehrerid, concat(abholort, ' ',  kundenname) as title, datumBeginn as start, datumEnde as end, status as class 
        FROM termine";

    if($stmt = mysqli_prepare($link, $sql)){

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            $rowsJson = array();
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                while ($row = $result -> fetch_assoc()){   
                    $startDateMS = 1000 * strtotime($row['start']);
                    $endDateMS = 1000 * strtotime($row['end']);


                    array_push($rowsJson, array(
                        "id" => $row['id'],
                        "title" => $row['title'],
                        /* "class" => $row['class'], */
                        "class" => "event-important",
                        "start" => $startDateMS,
                        "end" => $endDateMS
                    ));
                }
                $data = '{"success": 1,"result":'
                    .json_encode($rowsJson, JSON_PRETTY_PRINT).
                    '}'
                    ;

                //create json file
                    $filename = 'skilehrerTermine.json';
                    if(file_put_contents($filename, $data)){
                        echo 'Json file created';
                    } 
                    else{
                        echo 'An error occured in creating the file';
                    }
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