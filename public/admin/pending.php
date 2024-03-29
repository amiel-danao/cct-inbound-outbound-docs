\<?php
session_start();
$root_path = $_SESSION['root_path'];
$public_path = $_SESSION['public_path'];
include $root_path . '/db_connect.php';
include $root_path . "/session_checker.php";
?>

<?php
require_once $root_path . '/models/User.php';
$user = unserialize($_SESSION["user"]);
$messages = array();

if ($user->userType != 'admin' && $user->userType != 'admin2'){
	header("Location: ".$public_path."/logout.php");
	exit;
}

if (!empty($_GET['id'])) {
	$document_id = $_GET['id'];
	$query = "UPDATE documents SET status = 'pending' WHERE id = $document_id";
	mysqli_query($conn, $query);
	$messages[] = "Document was pended successfully.";
}

header("Location: ".$public_path."/admin/approved_page.php");
$_SESSION['messages'] = $messages;
exit;

?>