<?php
session_start();
$root_path = $_SESSION['root_path'];
$public_path = $_SESSION['public_path'];
include $root_path . '/db_connect.php';
include $root_path . "/session_checker.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link href="<?php echo $public_path; ?>/css/bootstrap.css" rel="stylesheet" />
  	<script src="<?php echo $public_path; ?>/js/bootstrap.bundle.min.js"></script>
    <title>Users</title>
  </head>
  <body style="background-color:	#8B0000;">
  <div class="row">
    <!--sidebar-->
  	<?php include $root_path . "/sidebar.php"; ?>
    <!--Table-->
    <div class="col p-5">
		<a type="button" href="<?php echo $public_path . "/user_creation.php"; ?>" class="btn btn-primary mb-2">Add user</a>
    <table class="table bg-white">
    <thead>
      <tr>
	  	<th>ID</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Contact Number</th>
      </tr>
    </thead>
    <tbody>

		<?php
		include $root_path .'/db_connect.php';

      // Select data from users table
      $sql = "SELECT id, username, first_name, middle_name, last_name, contact_number FROM users";
      $result = mysqli_query($conn, $sql);

      // Check for errors
      if (!$result) {
          die("Error executing query: " . mysqli_error($conn));
      }

      // Generate table using result data
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row["id"] . "</td>";
          echo "<td>" . $row["username"] . "</td>";
          echo "<td>" . $row["first_name"] . "</td>";
          echo "<td>" . $row["middle_name"] . "</td>";
          echo "<td>" . $row["last_name"] . "</td>";
          echo "<td>" . $row["contact_number"] . "</td>";
          echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";

      mysqli_close($conn);
		?>
    </tbody>
    </table>

    </div>
    <!-- <section class="ftco-section">
      <div class="container" style="background-color: white; width: 50%; position: fixed; top:110px; left:0; right:0;">
        <div class="row">
          <div class="col-md-12">
            <h4 class="text-center mb-4">Dashboard</h4>
            <div class="table-wrap">
              <table class="table">
                <thead class="thead-primary">
                  <tr>
                    <th>File Name</th>
                    <th>Sent By</th>
                    <th>Upload Date</th>
                    <th>Status</th>
                    <th>Download Link</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td> <?php echo $file_name; ?> </td>
                    <td> <?php echo $sent_by; ?> </td>
                    <td> <?php echo $upload_date; ?> </td>
                    <td> <?php echo $status; ?> </td>
                    <td>
                      <a href="
																			<?php echo $download_link; ?>">Download </a>
                    </td>
                  </tr>
                  <tr>
                    <td> <?php echo $file_name; ?> </td>
                    <td> <?php echo $sent_by; ?> </td>
                    <td> <?php echo $upload_date; ?> </td>
                    <td> <?php echo $status; ?> </td>
                    <td>
                      <a href="
																			<?php echo $download_link; ?>">Download </a>
                    </td>
                  </tr>
                  <tr>
                    <td> <?php echo $file_name; ?> </td>
                    <td> <?php echo $sent_by; ?> </td>
                    <td> <?php echo $upload_date; ?> </td>
                    <td> <?php echo $status; ?> </td>
                    <td>
                      <a href="
																			<?php echo $download_link; ?>">Download </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
   -->
   </div>
  </body>
</html>