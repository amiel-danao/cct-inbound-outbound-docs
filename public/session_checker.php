<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


// Check if the user is logged in
if (!isset($_SESSION["username"])) {
  // If not, redirect to the login page
  header("Location: login.php");
  exit;
}

?>