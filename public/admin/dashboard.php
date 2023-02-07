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
  	<?php include $root_path . "/includes.php";?>
    <title>Dashboard</title>
  </head>
  <body style="background-color:	#8B0000;">
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

      // echo "Number of users: " . $num_users;

      mysqli_close($conn);
    ?>

    
    <div class="col p-5">
      <div class="row">
        <div class="card col-4 bg-primary m-3" >
          <div class="card-body">
            <h5 class="card-title text-white">Users</h5>
            <p class="card-text">
              <span class="badge badge-secondary">Number of Users: <strong> <?php echo $num_users; ?> </strong>
              </span>
            </p>
          </div>
        </div>
        <div class="card col-4 m-3" >
          <div class="card-body">
            <h5 class="card-title">Files</h5>
            <p class="card-text">
              <span class="badge badge-secondary">Number of Files: <strong> <?php echo $num_files; ?> </strong>
              </span>
            </p>
          </div>
        </div>
      </div>
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