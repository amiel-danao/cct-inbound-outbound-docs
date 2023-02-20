<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$root = 'http://localhost/cct-inbound-outbound-docs/public';
date_default_timezone_set('Asia/Manila');
// Check if the user is logged in
if (!isset($_SESSION["user"])) {
	// If not, redirect to the login page
	$_SESSION = array();
	session_destroy();
	header("Location: ".$root."/login.php");
	goto clear;
}


require_once dirname( __FILE__ ) . '/models/User.php';
require_once 'db_connect.php';
$user = unserialize($_SESSION["user"]);

$sql = "SELECT active FROM users WHERE id='$user->id'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    goto clear;
}

if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	if (!isset($row['active'])){
		goto clear;
	}

	if ($row['active'] == 0){
		goto clear;
	}
}

return;
clear:
$_SESSION = array();
session_destroy();
header("Location: ".$root."/login.php");


?>