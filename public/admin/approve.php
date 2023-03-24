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
$messages = array();

if ($user->userType != 'admin' && $user->userType != 'admin2'){
	header("Location: ".$public_path."/logout.php");
	exit;
}

if (!empty($_GET['id'])) {
	$document_id = $_GET['id'];
	$date_approved = date('Y-m-d H:i:s');

	if ($user->userType == 'admin'){
		$query = "UPDATE documents SET approver1 = '$user->username', date_approved1 = '$date_approved' WHERE id = $document_id";
		$message = 'Document is now for admin2 approval';
	}
	else if ($user->userType == 'admin2'){
		$query = "UPDATE documents SET status = 'approved', approver2 = '$user->username', date_approved2 = '$date_approved' WHERE id = $document_id";
		$message = 'Document was approved successfully.';
	}
	mysqli_query($conn, $query);
	$messages[] = $message;
}

header("Location: ".$public_path."/admin/pending_page.php");
$_SESSION['messages'] = $messages;
exit;

?>