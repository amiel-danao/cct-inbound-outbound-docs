<?php
  include 'db_connect.php';
  $public_path = 'http://localhost/cct-inbound-outbound-docs/public';
  $root_path = dirname(__FILE__);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
      die("Error executing query: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
      session_start();


      $_SESSION['root_path'] = $root_path;
      $_SESSION['public_path'] = $public_path;
      require_once $root_path . '\models\User.php';

      $row = mysqli_fetch_assoc($result);
      $user_type = $row['user_type'];

      if (!isset($row['active']) || $row['active'] == 0){
		  $errors[] = 'This account has been deactivated!';
		  goto end;
	  }

      $user = new User($row['id'], $row['username'], $row['first_name'], $row['middle_name'], $row['last_name'], $row['contact_number'], $user_type, $row['last_login'], $row['active']);
      $_SESSION['user'] = serialize($user);

      $now = date("Y-m-d H:i:s");

	  // Update the last login date for the user
	  $sql = "UPDATE users SET last_login = '$now' WHERE id = $user->id";
	  mysqli_query($conn, $sql);

      if ($user_type == 'admin' || $user_type == 'system') {

        $_SESSION['username'] = $username;
        header("location: admin/dashboard.php");
      } else {
        $_SESSION['username'] = $username;
        header("location: dashboard.php");
      }
    } else {
      $errors[] = "Invalid username or password";
      goto end;
    }

    end:

    $_SESSION['errors'] = $errors;
  }
  mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php include $root_path . "/includes.php";?>
	<title>Login</title>
</head>
<!--login details-->
<body class="hold-transition bg-secondary">
	<div class="wrapper">


		
		<div class="container-fluid">
			<div class="row text-center p-5">

				<div class="col-6 card mx-auto">
					<div class="card-header">
						<img class="mb-4 img-fluid" src="<?php echo $public_path; ?>\images\logo.png" alt="logo" />
					</div>
					<div class="card-body">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

							<h1 class="h3 mb-3 fw-normal" style="color:white">Login</h1>
							<div class="form-floating">
								<input type="text" name="username" class="form-control" placeholder="" />
								<label for="floatingInput">Username</label>
							</div>
							<div class="form-floating">
								<input type="password" name="password" class="form-control" placeholder="Password" />
								<label for="floatingPassword">Password</label>
							</div>
							<button type="submit" class="btn btn-primary">Sign In</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include $root_path . "/includes_js.php";?>
	<?php include $root_path . "/messaging.php" ?>
</body>
</html>