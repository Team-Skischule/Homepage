<!DOCTYPE html>
<html>

<!-- (B) PROCESS PASSWORD RESET REQUEST -->
<?php

  $result = "";
  if (isset($_POST['email'])) {
    // (B1) CONNECT TO DATABASE
    require "2a-common.php";

    // (B2) CHECK IF VALID USER
    $stmt = $pdo->prepare("SELECT * FROM skilehrer WHERE email=?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = is_array($user)
      ? ""
      : $_POST['email'] . " is not registered.";

    // (B3) CHECK PREVIOUS REQUEST (PREVENT SPAM)
    if ($result == "") {
      $stmt = $pdo->prepare("SELECT * FROM password_reset WHERE user_id = ?");
      $stmt->execute([$user['id']]);
      $request = $stmt->fetch(PDO::FETCH_ASSOC);
      $now = strtotime("now");
      if (is_array($request)) {
        $expire = strtotime($request['reset_time']) + $prvalid;
        if ($now < $expire) {
          $result = "Please try again later";
        }
      }
    }

    // (B4) CHECKS OK - CREATE NEW RESET REQUEST
    if ($result == "") {
      // RANDOM HASH
      $hash = md5($user['email'] . $now);
      debug_to_console($user['email']);
      debug_to_console($hash);
      // DATABASE ENTRY
      $stmt = $pdo->prepare("REPLACE INTO password_reset VALUES (?,?,?)");
      $stmt->execute([$user['id'], $hash, date("Y-m-d H:i:s")]);

      // SEND EMAIL
      $subject = "Password reset";
      //$link = "https://projektskischule.000webhostapp.com/Homepage/2c-reset.php?i=" . $user['id'] . "&h=" . $hash;
      //$link = "https://projektskischule.000webhostapp.com/Homepage/2c-reset.php?id=" . $user['id'] . "&h=" . $hash . "&e=" . $user['email'];
      $link = "https://projektskischule.000webhostapp.com/Homepage/reset-password.php?e=" . $_POST['email'];
      $message = "<a href='$link'>Click here to reset password</a>";
      if (!@mail($user['email'], $subject, $message)) {
        $result = "Failed to send email!";
      }
    }

    // (B5) RESULTS
    if ($result == "") {
      $result = "Email has been sent - Please click on the link in the email to confirm.";
    }
    // echo "<div>$result</div>";
  }
  function debug_to_console($data)
  {
    $output = $data;
    if (is_array($output))
      $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
  }
  ?>

<head>
  <title>Password Reset Request</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="Description" content="Login Seite für die Verwaltungssoftware der Skischule Arlberg.">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="style.css"> 
</head>

<body class="home sessionForm">
  <!-- (A) PASSWORD RESET FORM -->
  <div class="form-container">
        <span class="help-block"><?php echo $result; ?></span>
    <form method="post" target="_self">
      <div class="form-group">
        <label for="email" class="col-sm-4 col-form-label">E&#8209;Mail:</label>
        <input type="email" name="email" required class="form-control col-sm-8" placeholder="skilehrer@arlberg.at"></input>
      </div>
      <div class="row">
        <input type="submit"  class="btn btn-primary" value="Passwort zurücksetzen" />
      </div>
    </form>
  </div>

  

</body>

</html>