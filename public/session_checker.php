<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$root = 'http://localhost/cct-inbound-outbound-docs/public';

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
  // If not, redirect to the login page
	header("Location: ".$root."/login.php");
  exit;
}

?>