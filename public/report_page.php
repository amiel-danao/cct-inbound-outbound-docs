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
	$selectedYear = $_POST['year'];
	$selectedMonth = $_POST["month"];
}
else{
	$selectedYear = date("Y");
	$selectedMonth = '01';
}

$document_date_query = "AND (date_upload BETWEEN '$selectedYear-$selectedMonth-01' AND '$selectedYear-$selectedMonth-31');";


require_once $root_path . '/models/User.php';
$user = unserialize($_SESSION["user"]);

$errors = array();

$sql = "SELECT * FROM documents WHERE uploaded_by='$user->username' $document_date_query";

$result = mysqli_query($conn, $sql);

if (!$result) {
	$errors[] = "Error executing query: " . mysqli_error($conn);
	goto end;
}

$counts = array("approved"=>0, "pending"=> 0, "rejected"=> 0, "archive"=> 0);
$total_files = 0;

while($row = $result->fetch_assoc()) {
	$status = $row["status"];
	$counts[$status]++;
	$total_files++;
}

if ($total_files > 0){
	$approved_percent = round(($counts['approved']/$total_files) * 100, 2);
	$pending_percent = round(($counts['pending']/$total_files) * 100, 2);
	$rejected_percent = round(($counts['rejected']/$total_files) * 100, 2);
	$archive_percent = round(($counts['archive']/$total_files) * 100, 2);
}
else{
	$approved_percent = 0;
	$pending_percent = 0;
	$rejected_percent = 0;
	$archive_percent = 0;
}


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
										<td>Approved Files
										<span class="badge bg-success"><?php echo $counts['approved'] ?></span>
										</td>
										<td>
										<div class="progress progress-xs">
											<div id="approve_progressbar" class="progress-bar bg-success" style="width: <?php echo $approved_percent.'%' ?>"></div>
										</div>
										</td>
										<td>
										<span id="approve_percent" class="badge bg-success"><?php echo $approved_percent.'%' ?></span>
										</td>
									</tr>
									<tr>
										<td>2.</td>
										<td>Pending Files
										<span class="badge bg-primary"><?php echo $counts['pending'] ?></span>
										</td>
										<td>
										<div class="progress progress-xs">
											<div class="progress-bar bg-primary" style="width: <?php echo $pending_percent.'%' ?>"></div>
										</div>
										</td>
										<td>
										<span class="badge bg-primary"><?php echo $pending_percent.'%' ?></span>
										</td>
									</tr>
									<tr>
										<td>3.</td>
										<td>Rejected Files
										<span class="badge bg-warning"><?php echo $counts['rejected'] ?></span>
										</td>
										<td>
										<div class="progress progress-xs progress-striped active">
											<div class="progress-bar bg-warning" style="width: <?php echo $rejected_percent.'%' ?>"></div>
										</div>
										</td>
										<td>
										<span class="badge bg-warning"><?php echo $rejected_percent.'%' ?></span>
										</td>
									</tr>
									<tr>
										<td>4.</td>
										<td>Archive Files
										<span class="badge bg-danger"><?php echo $counts['archive'] ?></span>
										</td>
										<td>
										<div class="progress progress-xs progress-striped active">
											<div class="progress-bar bg-danger" style="width: <?php echo $archive_percent.'%' ?>"></div>
										</div>
										</td>
										<td>
										<span class="badge bg-danger"><?php echo $archive_percent.'%' ?></span>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-4">
							<div class="callout callout-info">
								<h5>Last login</h5>
								<p><?php echo $user->lastLogin; ?></p>
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