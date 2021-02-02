<?php
        include "../config.php";

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$skilevel = $_POST['skilevel'];
$snowboardlevel = $_POST['snowboardlevel'];
$birthdate = $_POST['birthdate'];
$comment = $_POST['comment'];
$id = $_POST['id'];


$stmt = $link->prepare("Update skilehrer Set firstname = ?, lastname = ?, mobile = ?, email = ?, skilevel = ?, snowboardlevel = ?, birthdate = ?, comment = ? Where id = ?");

                $stmt->bind_param("ssssiissi", $firstname, $lastname, $mobile, $email, $skilevel, $snowboardlevel, $birthdate, $comment, $id);
                $stmt->execute();

                echo "Skilehrer: ".$firstname." ".$lastname." wurde angelegt";
                    
                $stmt->close();
                $link->close();
?>