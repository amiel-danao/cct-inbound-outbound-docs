<?php
session_start();
include "../session_checker.php";
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
  			<?php include $root_path . "/sidebar.php"; ?>
  			<!----bootstrap cards-->

  			<?php
      $sql = "SELECT COUNT(*) FROM users";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
          die("Error executing query: " . mysqli_error($conn));
      }

      $row = mysqli_fetch_row($result);
      $num_users = $row[0];

      $sql = "SELECT COUNT(*) FROM documents";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
          die("Error executing query: " . mysqli_error($conn));
      }

      $row = mysqli_fetch_row($result);
      $num_files = $row[0];

      $sql = "SELECT COUNT(*) FROM documents WHERE archive = 1";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
          die("Error executing query: " . mysqli_error($conn));
      }

      $row = mysqli_fetch_row($result);
      $num_archive = $row[0];

      $sql = "SELECT COUNT(*) FROM documents WHERE status = 'pending'";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
          die("Error executing query: " . mysqli_error($conn));
      }

      $row = mysqli_fetch_row($result);
      $num_pending = $row[0];

      mysqli_close($conn);
  			?>


  			<div class="col p-5">
  				<div class="row">
  					<div class="card col-4 bg-primary m-3">
  						<div class="card-body">
  							<h5 class="card-title text-white">Users</h5>
  							<p class="card-text">
  								<span class="badge badge-secondary">
  									Number of Users: <strong>
  										<?php echo $num_users; ?>
  									</strong>
  								</span>
  							</p>
  						</div>
  					</div>
  					<div class="card col-4 m-3">
  						<div class="card-body">
  							<h5 class="card-title">Total Files</h5>
  							<p class="card-text">
  								<span class="badge badge-secondary text-black">
  									Number of Files: <strong>
  										<?php echo $num_files; ?>
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

  					<div class="card col-4 bg-success m-3">
  						<div class="card-body">
  							<h5 class="card-title text-white">Pending</h5>
  							<p class="card-text">
  								<span class="badge badge-secondary">
  									Number of Files: <strong>
  										<?php echo $num_pending; ?>
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