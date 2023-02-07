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
	$sql = "SELECT file_name, file_path, send_to, date_upload, document_type, status FROM documents WHERE (uploaded_by='$user->username') AND (file_name LIKE ? OR send_to LIKE ? OR uploaded_by LIKE ?)";

	$stmt = $conn->prepare($sql);
	if ($stmt) {
	} else {
		$errors[] = "Error search: " . $conn->error;
		goto end;
	}

	$search_terms = "%" . $_POST['search_terms'] . "%";
	$stmt->bind_param("sss", $search_terms, $search_terms, $search_terms);
} else {
	$sql = "SELECT file_name, file_path, send_to, date_upload, document_type, status FROM documents WHERE uploaded_by='$user->username'";
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<?php include $root_path . "/includes.php";?>  	
    <title>Document Management</title>
  </head>
  <body style="background-color:	#8B0000">
  	<?php include $root_path . "/messaging.php" ?>
<div class="container-fluid">
    <div class="row">
    <!--sidebar--> 
    <?php include "sidebar.php"; ?>
<!--Table-->    

 
  <div class="col p-5">
      <h1 class="text-white">Sent Files</h1>
  	<?php include $root_path . "/search.php"; ?>
  <div class="table-wrap">
  <table class="table bg-white">
  <thead class="thead-primary">
  <tr>
  <th>File Name</th>
  <th>Send To</th>
  <th>Upload Date</th>
  <th>Status</th>
    <th>Type</th>
  <th>Download Link</th>
  </tr>
  </thead>
  <tbody>
  	<?php
	  if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>' . $row["file_name"]. '</td>
                    <td>' . $row["send_to"]. '</td>
                    <td>' . $row["date_upload"]. '</td>
                    <td>' . $row["status"]. '</td>
                    <td>' . $row["document_type"]. '</td>
                    <td><a type="button" class="btn btn-success" target="_blank" href="' . $public_path . $row["file_path"] . '">Download</a></td>
                  </tr>';
        }
	  }
	  else{
          echo '<tr>
                  <td colspan="6" class="text-center">No records...</td>
                </tr>';
	  }
  	?>

  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>
  </body>
</html>