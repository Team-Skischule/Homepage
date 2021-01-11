<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$test = $_SESSION["test"];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

    <style>
        aside {
            width: 30%;
            padding: 10px;
            font-style: italic;
            background-color: lightgrey;
            float: right;
        }
    </style>
</head>

<body>


<h1>Skilehrer &Uuml;bersicht</h1>
    <p>Hier könnte ihr Text stehen </p>

    <aside>
        <pre>
In das Vornamefeld deinen Benutzernamen eingeben
    In das Nachnamefeld deinen Nachnamen eingeben
</pre>
    </aside>
    <h3 style="color:blue"><?php echo $test?></h3>
    <?php $_SESSION["test2"] = "Testtext 2";?>
    <p>Hier könnte ihr Text stehen ladsjfsaöldfjöalsdf</p>
    <p>Hier könnte ihr Text stehen ladsjfsaöldfjöalsdf</p>
    <p>asdfsdfasfsadf</p>
    <p>Hier könnte ihr Text stehen ladsjfsaöldfjöalsdf</p>
    <p id="test1">Hier könnte ihr Text stehen ladsjfsaöldfjöalsdf</p>

    <p>test stest<br></p>
    
        <a href="welcome.php" class="btn btn-danger">Zurück zur Willomen Seite</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>

    
</body>

</html>