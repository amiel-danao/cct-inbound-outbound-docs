<?php
session_start();
$root_path = $_SESSION['root_path'];
$public_path = $_SESSION['public_path'];
include $root_path . '/db_connect.php';
include $root_path . "/session_checker.php";
?>

<?php
require_once $root_path . '/models/User.php';
$user = unserialize($_SESSION["user"]);
$is_user_query = "send_to='$user->username' AND";

if ($user->userType == 'admin' || $user->userType == 'admin2'){
	$is_user_query = '';
}


$messages = array();

if (!empty($_GET['id'])) {
	$document_id = $_GET['id'];
	$date_archived = date('Y-m-d H:i:s');

	$query = "UPDATE documents SET status = 'archive', date_archived = '$date_archived' WHERE $is_user_query id = $document_id;";
	mysqli_query($conn, $query);
	$messages[] = "Document was archived successfully.";
}

header("Location: ".$public_path."/archive_page.php");
$_SESSION['messages'] = $messages;
exit;

?>