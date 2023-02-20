<?php
session_start();
include "session_checker.php";
$root_path = $_SESSION['root_path'];
$public_path = $_SESSION['public_path'];
include $root_path . '/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<?php include $root_path . "/includes.php";?>
    <title>Dashboard</title>
  </head>
  <body style="background-color:	#8B0000;">
  	<?php include $root_path . "/messaging.php" ?>
  	<div class="container-fluid">
  		<div class="row">
  			<!--sidebar-->
  			<?php include "sidebar.php"; ?>

  			<?php
        require_once $root_path . '/models/User.php';
        $user = unserialize($_SESSION["user"]);

      $sql = "SELECT COUNT(*) FROM documents WHERE send_to = '$user->username'";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
          die("Error executing query: " . mysqli_error($conn));
      }

      $row = mysqli_fetch_row($result);
      $num_files_received = $row[0];

      $sql = "SELECT COUNT(*) FROM documents WHERE archive = 1 AND send_to = '$user->username'";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
          die("Error executing query: " . mysqli_error($conn));
      }

      $row = mysqli_fetch_row($result);
      $num_archive = $row[0];

      $sql = "SELECT COUNT(*) FROM documents WHERE uploaded_by = '$user->username'";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
          die("Error executing query: " . mysqli_error($conn));
      }

      $row = mysqli_fetch_row($result);
      $num_sent = $row[0];

      mysqli_close($conn);
  			?>


  			<div class="col p-5">
  				<div class="row">
  					<div class="card col-4 m-3">
  						<div class="card-body">
  							<h5 class="card-title">Total Files Received</h5>
  							<p class="card-text">
  								<span class="badge badge-secondary text-black">
  									Number of Files: <strong>
  										<?php echo $num_files_received; ?>
  									</strong>
  								</span>
  							</p>
  						</div>
  					</div>


  					<div class="card col-4 bg-success m-3">
  						<div class="card-body">
  							<h5 class="card-title text-white">Total Files Sent</h5>
  							<p class="card-text">
  								<span class="badge badge-secondary">
  									Number of Files: <strong>
  										<?php echo $num_sent; ?>
  									</strong>
  								</span>
  							</p>
  						</div>
  					</div>

  					<div class="card col-4 bg-danger m-3">
  						<div class="card-body">
  							<h5 class="card-title text-white">Archived</h5>
  							<p class="card-text">
  								<span class="badge badge-secondary">
  									Number of Files: <strong>
  										<?php echo $num_archive; ?>
  									</strong>
  								</span>
  							</p>
  						</div>
  					</div>
  				</div>
  			</div>

  		</div>
</div></body>
</html>