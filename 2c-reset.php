<!DOCTYPE html>
<html>
  <head>
    <title>
      Password Reset Request Demo
    </title>
  </head>
  <body><?php 
  $result = "";
  echo "Ausgabe get id: " . $_GET["id"];
  echo "Ausgabe get h: " . $_GET["h"];

  if (isset($_GET["id"]) && isset($_GET["h"])) {
    // (A) CONNECT TO DATABASE
    require "2a-common.php";
    
    // (B) CHECK IF VALID REQUEST
    $stmt = $pdo->prepare("SELECT * FROM password_reset WHERE user_id=?");
    $stmt->execute([$_GET["id"]]);
    $request = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($request)) {
      if ($request['reset_hash'] != $_GET["h"]) { $result = "Invalid request"; }
    } else { $result = "Invalid request 1"; }

    // (C) CHECK EXPIRED
    if ($result=="") {
      $now = strtotime("now");
      $expire = strtotime($request['reset_time']) + $prvalid;
      if ($now >= $expire) { $result = "Request expired"; }
    }

    // (D) PROCEED PASSWORD RESET
    if ($result=="") {
      // RANDOM PASSWORD
      $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-=+?";
      //$password = password_hash(substr(str_shuffle($chars),0 ,8), PASSWORD_DEFAULT); // 8 characters
      $password = substr(str_shuffle($chars),0 ,8);
      // UPDATE DATABASE
      //$stmt = $pdo->prepare("UPDATE skilehrer SET password=? WHERE id=?");
      //$stmt->execute([$password, $_GET['id']]);
      $stmt = $pdo->prepare("DELETE FROM password_reset WHERE user_id=?");
      $stmt->execute([$_GET["id"]]);
      
      // SHOW RESULTS (UPDATED PASSWORD)
      $result = "Password has been updated to $password. Please login and change it.";
    }
  }

  // (E) INVALID REQUEST
  else { $result = "Invalid request 2"; }
  
  // (F) OUTPUT RESULTS
  //echo "<div>$result</div>";
  header("location: https://projektskischule.000webhostapp.com/Homepage/reset-password.php?e=" .$_GET["e"]);
  //header("location: https://projektskischule.000webhostapp.com/Homepage/login.php");
  ?></body>
</html>