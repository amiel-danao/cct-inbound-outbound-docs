<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$public_path = $_SESSION['public_path'];

    $login_location = "Location:". $public_path . "/login.php";
  // Unset all of the session variables
  $_SESSION = array();

  // Destroy the session
  session_destroy();

  // Redirect to the login page
  header($login_location);
  exit;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Login</title>
    <style>
      .button {
        background-color: #ffd700;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin: 4px 2px;
        cursor: pointer;
      }
      
      .button1 {font-size: 20px;}
      </style>
  </head>
<!--login details-->
    <body class="text-right;" style="background-color:	#8B0000;">
        <h1 class="text-white">Thank you for visiting the website today!</h1>

        <a type="button" href="login.php">Log in here again</a>
    </body>
</html>