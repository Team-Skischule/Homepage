<?php
/* ---
 Betrifft: Termine Anlegen Formular
    Wenn ein Termin ausgewählt im Datumsfeld (Beginn oder Ende) ausgewählt wurde dann
    wird überprüft ob bei dem betroffenen Skilehrer schon ein Termin eintrag für den ausgewählten Termin besteht
--- */

include "../config.php";

if(isset($_REQUEST["date"])){
    // Prepare a select statement
     $sql = "SELECT kundenname, abholort FROM skischule.termine WHERE skilehrerid=? AND ? between datumBeginn AND datumEnde";
    
   
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_id, $param_date);
        
        // Set parameters
        $param_date = $_REQUEST["date"];
        $param_id = $_REQUEST["id"];

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            $rowsJson = array();
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                
             
                echo  $param_date . " ist besetzt!";

            } else{
                echo "Termin frei";
            }
        } else{
            echo "ERROR: Could not be executed $sql. " . mysqli_error($link);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($link);

?>