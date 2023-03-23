<?php
session_start();
include "session_checker.php";
$root_path = $_SESSION['root_path'];
$public_path = $_SESSION['public_path'];
include $root_path . '/db_connect.php';
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['form_values'] = $_POST;
	$selectedYear = trim($_POST['year']);
	$selectedMonth = $_POST["month"];
}


require_once $root_path . '/models/User.php';
$user = unserialize($_SESSION["user"]);

$errors = array();

$sql = "SELECT COUNT(*) FROM documents WHERE uploaded_by='$user->username' AND status = 'approved';";

$result = mysqli_query($conn, $sql);

if (!$result) {
	$errors[] = "Error executing query: " . mysqli_error($conn);
	goto end;
}

$approved_count = mysqli_num_rows($result);
end:
$_SESSION['errors'] = $errors;
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
						<h1>Report</h1>
					</div>
					<input id="selectedYear" type="text" value="<?php if(isset($selectedYear)){ echo $selectedYear;} ?>" hidden />
					<input id="selectedMonth" type="text" value="<?php if(isset($selectedMonth)){ echo $selectedMonth;} ?>" hidden />
					<form method="post" id="filter-form">
						<div class="row mb-3">
							<div class="col-2">
								<select id='year-dropdown' class="form-control form-control-border rounded-0" name="year"></select>
							</div>
							<div class="col-2">
								<select class="form-control form-control-border rounded-0" id="month" name="month">
									<option value="01">January</option>
									<option value="02">February</option>
									<option value="03">March</option>
									<option value="04">April</option>
									<option value="05">May</option>
									<option value="06">June</option>
									<option value="07">July</option>
									<option value="08">August</option>
									<option value="09">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
								</select>
							</div>
						</div>
					</form>
					<div class="row">
						<div class="col-12 card card-primary card-outline">
							<div class="card-header">
								<h5 class="card-title">Documents</h5>
							</div>
							<div class="card-body p-0">
								<table class="table">
									<tbody>
									<tr>
										<td>1.</td>
										<td>Approved Files</td>
										<td>
										<div class="progress progress-xs">
											<div class="progress-bar bg-success" style="width: 55%"></div>
										</div>
										</td>
										<td>
										<span class="badge bg-danger">55%</span>
										</td>
									</tr>
									<tr>
										<td>2.</td>
										<td>Pending Files</td>
										<td>
										<div class="progress progress-xs">
											<div class="progress-bar bg-warning" style="width: 70%"></div>
										</div>
										</td>
										<td>
										<span class="badge bg-warning">70%</span>
										</td>
									</tr>
									<tr>
										<td>3.</td>
										<td>Rejected Files</td>
										<td>
										<div class="progress progress-xs progress-striped active">
											<div class="progress-bar bg-primary" style="width: 30%"></div>
										</div>
										</td>
										<td>
										<span class="badge bg-primary">30%</span>
										</td>
									</tr>
									<tr>
										<td>4.</td>
										<td>Archive Files</td>
										<td>
										<div class="progress progress-xs progress-striped active">
											<div class="progress-bar bg-success" style="width: 90%"></div>
										</div>
										</td>
										<td>
										<span class="badge bg-success">90%</span>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include $root_path . "/includes_js.php";?>
	<?php include $root_path . "/messaging.php" ?>
	<script src="js/moment.js" type="text/javascript"></script>
	<script>
		$(document).ready(function () {
			let yearSelect = document.getElementById('year-dropdown');

			let currentYear = new Date().getFullYear();
			let earliestYear = 1970;
			while (currentYear >= earliestYear) {
				let dateOption = document.createElement('option');
				dateOption.text = currentYear;
				dateOption.value = currentYear;
				yearSelect.add(dateOption);
				currentYear -= 1;
			}

			const selectedYear = document.getElementById('selectedYear');
			if (selectedYear.value != "") {
				yearSelect.value = selectedYear.value;
			}

			const monthSelect = document.querySelector('#month');
			const selectedMonth = document.getElementById('selectedMonth');
			if (selectedMonth.value != "") {
				monthSelect.value = selectedMonth.value;
			}

			let form = document.getElementById("filter-form");

			yearSelect.addEventListener("change", function () {
				form.submit();
			});

			monthSelect.addEventListener("change", function () {
				form.submit();
			});

			var data = new FormData(form);
			console.log(data);
		});
	</script>
</body>
</html>