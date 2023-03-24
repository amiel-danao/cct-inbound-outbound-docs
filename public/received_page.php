<?php
session_start();
include "session_checker.php";
$root_path = $_SESSION['root_path'];
$public_path = $_SESSION['public_path'];
include $root_path . '/db_connect.php';
?>

<?php
require_once $root_path . '/models/User.php';
$user = unserialize($_SESSION["user"]);

$errors = array();

if (isset($_POST['search_terms'])) {
	$sql = "SELECT id, file_name, file_path, uploaded_by, date_upload, document_type, status FROM documents WHERE (send_to='$user->username' AND archive = 0) AND (file_name LIKE ? OR send_to LIKE ? OR uploaded_by LIKE ?)";

	$stmt = $conn->prepare($sql);
	if ($stmt) {
	} else {
		$errors[] = "Error search: " . $conn->error;
		goto end;
	}

	$search_terms = "%" . $_POST['search_terms'] . "%";
	$stmt->bind_param("sss", $search_terms, $search_terms, $search_terms);
} else {
	$sql = "SELECT id, file_name, file_path, uploaded_by, date_upload, document_type, status FROM documents WHERE send_to='$user->username' AND status != 'archive'";
	$stmt = $conn->prepare($sql);
}
$stmt->execute();
$result = $stmt->get_result();

end:
$_SESSION['errors'] = $errors;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php include $root_path . "/includes.php";?>
	<title>Document Management</title>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?php include $root_path . "/sidebar.php"; ?>
		<div class="content-wrapper">
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<!--Table-->


						<div class="col p-5">
							<h1>Received Files</h1>
							<?php include $root_path . "/search.php"; ?>
							<div class="table-wrap">
								<table class="table bg-white">
									<thead class="thead-primary">
										<tr>
											<th>File Name</th>
											<th>Uploaded by</th>
											<th>Upload Date</th>
											<th>Status</th>
											<th>Type</th>
											<th>Download Link</th>
											<th>Archive</th>
											<th>Print</th>
										</tr>
									</thead>
									<tbody>
										<?php
							if (mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_assoc($result)) {
									echo '<tr>
                    <td>' . $row["file_name"]. '</td>
                    <td>' . $row["uploaded_by"]. '</td>
                    <td>' . $row["date_upload"]. '</td>
                    <td>' . $row["status"]. '</td>
                    <td>' . $row["document_type"]. '</td>';

					if ($row['status'] == 'approved'){
						echo '<td><a type="button" class="btn btn-success"  target="_blank" href="' . $public_path . $row["file_path"] . '">Download</a></td>';
						echo '<td><a type="button" class="btn btn-danger" href="'.$public_path.'/archive.php?id=' . $row['id'] . '">Archive</a></td>';
						echo '<td><a type="button" href="#" class="btn btn-warning" onclick="printFile(\''.$public_path.$row["file_path"].'\');">Print</a></td>';
					}
					else{
						echo '<td>Not yet available</td>';
						echo '<td>Not yet available</td>';
						echo '<td>Not yet available</td>';
					}

					echo '</tr>';
								}
							}
							else{
								echo '<tr>
                  <td colspan="8" class="text-center">No records...</td>
                </tr>';
							}
                                        ?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
			<iframe id="fileFrame" style="display:none;"></iframe>
	<?php include $root_path . "/includes_js.php";?>
	<?php include $root_path . "/messaging.php" ?>
			<script>
		function printFile(filePath) {
		  var fileFrame = document.getElementById("fileFrame");
		  fileFrame.src = filePath;
		  fileFrame.onload = function() {
			fileFrame.contentWindow.print();
		  }
		}
			</script>

</body>
</html>