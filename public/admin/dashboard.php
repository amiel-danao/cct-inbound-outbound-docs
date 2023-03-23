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

							<?php if ($user->userType == 'system'){?>
							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-header border-0">
											<h3 class="card-title">Recent Logins</h3>
										</div>
										<div class="card-body table-responsive p-0">
											<table class="table table-striped table-valign-middle">
												<thead>
													<tr>
														<th>Username</th>
														<th>First Name</th>
														<th>Last Name</th>
														<th>Last Login</th>
														<th>User Type</th>
													</tr>
												</thead>
												<tbody>
													<?php
														include $root_path .'/db_connect.php';
													  // Select data from users table
														$sql = "SELECT username, first_name, last_name, last_login, user_type FROM users WHERE NOT last_login is null ORDER BY last_login DESC LIMIT 5;";
													  $result = mysqli_query($conn, $sql);

													  // Check for errors
													  if (!$result) {
														  die("Error executing query: " . mysqli_error($conn));
													  }

													  // Generate table using result data
													  while ($row = mysqli_fetch_assoc($result)) {
														  echo "<tr>";
														  echo "<td>" . $row["username"] . "</td>";
														  echo "<td>" . $row["first_name"] . "</td>";
														  echo "<td>" . $row["last_name"] . "</td>";
														  echo "<td>" . $row["last_login"] . "</td>";
														  echo "<td>" . $row["user_type"] . "</td>";
														  echo "</tr>";
													  }

													  mysqli_close($conn);
													?>
												</tbody>
											</table>											
										</div>
									</div>

								</div>
							</div>
							<?php }?>


							<?php if ($user->userType == 'admin' || $user->userType == 'admin2'){?>
							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-header border-0">
											<h3 class="card-title">Recent Files</h3>
										</div>
										<div class="card-body table-responsive p-0">
											<table class="table table-striped table-valign-middle">
												<thead>
													<tr>
														<th>File Name</th>
														<th>Send To</th>
														<th>Uploaded By</th>
														<th>Date Uploaded</th>
													</tr>
												</thead>
												<tbody>
													<?php
															include $root_path .'/db_connect.php';
															$sql = "SELECT file_name, uploaded_by, send_to, date_upload, document_type FROM documents WHERE status = 'approved' ORDER BY date_upload DESC LIMIT 5;";
														  $stmt = $conn->prepare($sql);

														  $stmt->execute();
														  $result = $stmt->get_result();

														if (mysqli_num_rows($result) > 0) {
															while($row = mysqli_fetch_assoc($result)) {
																echo '<tr>
																	<td>' . $row["file_name"]. '</td>
																	<td>' . $row["send_to"]. '</td>
																	<td>' . $row["uploaded_by"]. '</td>
																	<td>' . $row["date_upload"]. '</td>
																	</tr>';
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
							<?php }?>
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