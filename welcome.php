<?php
// Initialize the session
session_start();

echo "<h3> PHP List All Session Variables</h3>";
foreach ($_SESSION as $key=>$val)
echo $key." ".$val."<br/>";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


$_SESSION["test"] = "asldkfa56456sdklöf234";
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h2><?php echo $_SESSION["test2"]?></h2>
   
    <span><?php echo implode(" ", $_SESSION)?></span>
    <span></span>

    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Willkommen, der Login hat geklappt.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        <a href="skilehrerpage1.php" class="btn btn-danger">Weiterleitung Testseite</a>
        
    </p>
</body>
</html>