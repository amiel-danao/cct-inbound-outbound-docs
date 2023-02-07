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

if (!empty($_GET['id'])) {
	$document_id = $_GET['id'];
	$query = "UPDATE documents SET archive = 1 WHERE id = $document_id AND send_to = '$user->username'";
	mysqli_query($conn, $query);
	$messages[] = "Document was archived successfully.";
}

header("Location: ".$public_path."/received_page.php");
$_SESSION['messages'] = $messages;
exit;

?>