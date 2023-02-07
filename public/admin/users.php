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
    <title>Users</title>
  </head>
  <body style="background-color:	#8B0000;">
  	<?php include $root_path . "/messaging.php" ?>
  	<div class="container-fluid">
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


  		</div>

          </div>
  </body>
</html>