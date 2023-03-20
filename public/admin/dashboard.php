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
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<!--sidebar-->
		<?php include $root_path . "/sidebar.php"; ?>
		<div class="content-wrapper">
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<h1>Dashboard</h1>
					</div>
					<div class="row">
						
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
								<div class="info-box col-4  m-3">
									<span class="info-box-icon bg-warning elevation-1">
										<i class="fas fa-users"></i>
									</span>
									<div class="info-box-content">
										<span class="info-box-text">Number of Users</span>
										<span class="info-box-number">
											<?php echo $num_users; ?>
										</span>
									</div>

								</div>

								<?php if ($user->userType != 'system'){?>
								<div class="info-box col-4  m-3">
									<span class="info-box-icon bg-success elevation-1">
										<i class="far fa-copy"></i>
									</span>
									<div class="info-box-content">
										<span class="info-box-text">Number of Files</span>
										<span class="info-box-number">
											<?php echo $num_files; ?>
										</span>
									</div>

								</div>

								<div class="info-box col-4  m-3">
									<span class="info-box-icon bg-danger elevation-1">
										<i class="fas fa-users"></i>
									</span>
									<div class="info-box-content">
										<span class="info-box-text">Archived</span>
										<span class="info-box-number">
											<?php echo $num_archive; ?>
										</span>
									</div>

								</div>

								<div class="info-box col-4  m-3">
									<span class="info-box-icon bg-info elevation-1">
										<i class="fas fa-users"></i>
									</span>
									<div class="info-box-content">
										<span class="info-box-text">Pending</span>
										<span class="info-box-number">
											<?php echo $num_pending; ?>
										</span>
									</div>

								</div>

								<?php }?>
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