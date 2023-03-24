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
	<body class="hold-transition sidebar-mini">
		<div class="wrapper">
			<?php include $root_path . "/sidebar.php"; ?>
			<div class="content-wrapper">
				<div class="content">
					<div class="container-fluid">
						<div class="row">
							<h1>Dashboard</h1>
						</div>
						<div class="row">

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

      $sql = "SELECT COUNT(*) FROM documents WHERE status = 'archive' AND send_to = '$user->username'";
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
									<div class="info-box col-4  m-3">
										<span class="info-box-icon bg-success elevation-1">
											<i class="fas fa-copy"></i>
										</span>
										<div class="info-box-content">
											<span class="info-box-text">Total Files Received</span>
											<span class="info-box-number">
												<?php echo $num_files_received; ?>
											</span>
										</div>

									</div>

									<div class="info-box col-4  m-3">
										<span class="info-box-icon bg-primary elevation-1">
											<i class="fas fa-copy"></i>
										</span>
										<div class="info-box-content">
											<span class="info-box-text">Total Files Sent</span>
											<span class="info-box-number">
												<?php echo $num_sent; ?>
											</span>
										</div>

									</div>


									<div class="info-box col-4  m-3">
										<span class="info-box-icon bg-danger elevation-1">
											<i class="fas fa-copy"></i>
										</span>
										<div class="info-box-content">
											<span class="info-box-text">Total Files Archived</span>
											<span class="info-box-number">
												<?php echo $num_sent; ?>
											</span>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	<?php include $root_path . "/includes_js.php";?>
	<?php include $root_path . "/messaging.php" ?>
</body>

</html>