<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["email"])) {
  // If not, redirect to the login page
  header("Location: login.php");
  exit;
}

?>