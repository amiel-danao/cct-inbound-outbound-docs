<?php
session_start();
$root_path = $_SESSION['root_path'];
$public_path = $_SESSION['public_path'];
include $root_path . '/db_connect.php';
include $root_path . "/session_checker.php";
?>
<?php
require_once $root_path . '/models/User.php';
$user = unserialize($_SESSION["user"]);
if ($user->userType != 'admin'){
	// If not, redirect to the login page
	header("Location:" . $root_path . "/login.php");
	exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['form_values'] = $_POST;
	$username = $_POST["username"];
	$first_name = $_POST["first_name"];
	$middle_name = $_POST["middle_name"];
	$last_name = $_POST["last_name"];
	$password = $_POST["password"];
	$contact_number = $_POST["contact_number"];
    if(isset($_SESSION['form_values'])) {
		$form_values = $_SESSION['form_values'];
		unset($_SESSION['form_values']);
	}

	// Check if the username already exists
	$sql = "SELECT username FROM users WHERE username = '$username'";
	$result = $conn->query($sql);
    $errors = array();
    $messages = array();

	if ($result->num_rows > 0) {
		$errors[] = "Username already exists, please choose another.";
	} else {
		$sql = "INSERT INTO users (username, first_name, middle_name, last_name, password, contact_number)
    VALUES ('$username', '$first_name', '$middle_name', '$last_name', '$password', '$contact_number')";

		if ($conn->query($sql) === TRUE) {
			$messages[] =  "New user created successfully";
            unset($_SESSION['form_values']);
            header("Location:" . $public_path . "/admin/users.php");
			exit;
		} else {
			$errors[] = "Error: " . $sql . "<br>" . $conn->error;
		}
	}

    $_SESSION['messages'] = $messages;
    $_SESSION['errors'] = $errors;

	$conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<?php include $root_path . "/includes.php";?>
    <title>User Creation</title>
  </head>
  <body style="background-color:	#8B0000">
  	<?php include $root_path . "/messaging.php" ?>
     <!--sidebar--> 
  	<?php include $root_path . "/sidebar.php"; ?>
<!--Signup-->
<div class="mask d-flex align-items-center h-100 gradient-custom-3">  
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6 mx-auto">
        <div class="card" style="border-radius: 15px; background-color: #ffd700; position: relative; top:-390px; left:0; right:0;">
          <div class="card-body p-5">
            <h2 class="text-uppercase text-center mb-5">Create user</h2>
            <form method="post">

              <div class="form-outline mb-4">
			  	<input type="text" name="first_name" class="form-control form-control-lg" value="<?php echo isset($form_values['first_name']) ? $form_values['first_name'] : ''; ?>" required/ />
                <label class="form-label" for="form3Example2cg">First Name*</label>
              </div>

			<div class="form-outline mb-4">
				<input type="text" name="middle_name" class="form-control form-control-lg" value="<?php echo isset($form_values['middle_name']) ? $form_values['middle_name'] : ''; ?>" />
				<label class="form-label" for="form3Example2cg">Middle Name</label>
			</div>

              <div class="form-outline mb-4">
			  	<input type="text" name="last_name" id="form3Example3cg" class="form-control form-control-lg" value="<?php echo isset($form_values['last_name']) ? $form_values['last_name'] : ''; ?>" required />
                <label class="form-label" for="form3Example3cg">Last Name*</label>
              </div>

              <div class="form-outline mb-4">
			  	<input type="text" name="username" id="form3Example4cg" class="form-control form-control-lg" value="<?php echo isset($form_values['username']) ? $form_values['username'] : ''; ?>" required />
                <label class="form-label" for="form3Example4cg">Username*</label>
              </div>

              <div class="form-outline mb-4">
			  	<input type="tel" name="contact_number" id="form3Example5cg" class="form-control form-control-lg" value="<?php echo isset($form_values['contact_number']) ? $form_values['contact_number'] : ''; ?>" />
                <label class="form-label" for="form3Example5cg">Contact Number</label>
              </div>

              <div class="form-outline mb-4">
			  	<input type="password" name="password" class="form-control form-control-lg" value="<?php echo isset($form_values['password']) ? $form_values['password'] : ''; ?>" required />
                <label class="form-label" for="form3Example6cdg">Password*</label>
              </div>

			<div class="form-outline mb-4">
				<input type="password" name="confirm_password" class="form-control form-control-lg" value="<?php echo isset($form_values['confirm_password']) ? $form_values['confirm_password'] : ''; ?>" required />
				<label class="form-label" for="form3Example6cdg">Confirm Password*</label>
			</div>

              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Confirm</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  	
  </body>
</html>