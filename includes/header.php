<!-- Dies muss im anderen Dokument eingefügt und angepasst sein:
  <!DOCTYPE html>
  <html lang="de">
    <head>
      <title</title>
   -->
<?php
// Initialize the session
session_start();

/* echo "<h3> PHP List All Session Variables</h3>";
foreach ($_SESSION as $key => $val)
  echo $key . " " . $val . "<br/>"; */
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: /Homepage/login.php");
  exit;
}
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
<!-- </head> muss im anderen PHP file eingefügt werden.
Damit kann man individuelle Dateien laden -->