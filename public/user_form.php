<?php
session_start();
include "session_checker.php";
$root_path = $_SESSION['root_path'];
$public_path = $_SESSION['public_path'];
include $root_path . '/db_connect.php';
?>

<?php
function is_password_strong($password) {
  $uppercase = preg_match('@[A-Z]@', $password);
  $lowercase = preg_match('@[a-z]@', $password);
  $number    = preg_match('@[0-9]@', $password);
  $specialChars = preg_match('@[^\w]@', $password);

  if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
    return false;
  }
  else {
    return true;
  }
}
?>

<?php
require_once $root_path . '/models/User.php';
$user = unserialize($_SESSION["user"]);
if ($user->userType != 'system'){
	// If not, redirect to the login page
	header("Location:" . $root_path . "/login.php");
	exit;
}

$typeOfEdit = "New";
$pageTitle = "User Creation";

if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    $userIdToEdit = $_GET['user_id'];
    $typeOfEdit = "Edit";
    $pageTitle = "Edit User";
}

$errors = array();
$messages = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['form_values'] = $_POST;
	$username = trim($_POST['username']);
	$first_name = $_POST["first_name"];
	$middle_name = $_POST["middle_name"];
	$last_name = $_POST["last_name"];
	$password = $_POST["password"];
	$contact_number = $_POST["contact_number"];
    $confirm_password = $_POST["confirm_password"];
    $user_type = $_POST["user_type"];
    $active = $_POST["active"];
    if(isset($_SESSION['form_values'])) {
		$form_values = $_SESSION['form_values'];
		unset($_SESSION['form_values']);
	}

    $specialCharsInUsername = preg_match('@[^\w]@', $username);
    if ($specialCharsInUsername){
		$errors[] = 'The username cannot contain special characters!';
        goto end;
	}

    if (preg_match('/\s/', $username)) {
        $errors[] = 'The username cannot contain whitespaces!';
        goto end;
	}

    if (!is_password_strong($password)) {
		$errors[] = 'Password must contain: 1 uppercase, 1 lowercase, 1 number, 1 special characters and must be atleast 8 characters in length!';
        goto end;
	}

    if ($password != $confirm_password){
		$errors[] = 'Password doesn\'t match!';
        goto end;
	}

    if ($typeOfEdit == "New"){
		// Check if the username already exists
		$sql = "SELECT username FROM users WHERE username = '$username'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$errors[] = "Username already exists, please choose a different username.";
            goto end;
		} else {
			$sql = "INSERT INTO users (username, first_name, middle_name, last_name, password, contact_number, user_type, active)
    VALUES ('$username', '$first_name', '$middle_name', '$last_name', '$password', '$contact_number', '$user_type', '$active')";

			if ($conn->query($sql) === TRUE) {
				$messages[] =  "New user created successfully";
				unset($_SESSION['form_values']);
				header("Location:" . $public_path . "/admin/users.php");
				exit;
			} else {
				$errors[] = "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
    else{
        $sql = "SELECT id, username FROM users WHERE username = '$username'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['id'] != $userIdToEdit){
				$errors[] = "Username already exists, please choose a different username.";
				goto end;
			}
		}
		
        $sql = <<<EOD
        UPDATE users SET 
            username = :username,
            first_name = :first_name,
            middle_name=:middle_name,
            last_name=:last_name,
            contact_number=:contact_number,
            user_type=:user_type,
            active=:active,
            password=:password
             WHERE id = :id
        EOD;
		// Prepare the update statement with placeholders for the values
		$updateStmt = $pdo->prepare($sql);

		// Bind the values to the placeholders
		$updateStmt->bindParam(':username', $username);
        $updateStmt->bindParam(':password', $password);
		$updateStmt->bindParam(':first_name', $first_name);
        $updateStmt->bindParam(':middle_name', $middle_name);
        $updateStmt->bindParam(':last_name', $last_name);
        $updateStmt->bindParam(':contact_number', $contact_number);
        $updateStmt->bindParam(':user_type', $user_type);
        $updateStmt->bindParam(':active', $active);
		$updateStmt->bindParam(':id', $userIdToEdit);

		// Execute the prepared statement
		$updateStmt->execute();

        $errorInfo = $updateStmt->errorInfo();
        if($errorInfo[0] != "00000"){
          // Handle error, print error message or log it.
          $errors[] = $errorInfo[2];
          goto end;
        }

        $messages[] = "user updated successfully.";
        goto end;
	}
}
else if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if (isset($userIdToEdit)){
        $sql = "SELECT * FROM users WHERE id=$userIdToEdit";
		$result = mysqli_query($conn, $sql);

		if (!$result) {
            $error = mysqli_error($conn);
            $errors[] = $error;
            goto end;
		}

        if (mysqli_num_rows($result) <= 0) {
            $errors[] = 'user id :'.$userIdToEdit. ' doesn\'t exist!';
            goto end;
		}
		$row = mysqli_fetch_assoc($result);
        
        $form_values['first_name'] = $row['first_name'];
        $form_values['middle_name'] = $row['middle_name'];
        $form_values['last_name'] = $row['last_name'];
        $form_values['username'] = $row['username'];
        $form_values['password'] = $row['password'];
        $form_values['confirm_password'] = $row['password'];
        $form_values['contact_number'] = $row['contact_number'];
        $form_values['user_type'] = $row['user_type'];
        $form_values['active'] = $row['active'];
	}
}

end:
    $conn->close();
    $_SESSION['messages'] = $messages;
    $_SESSION['errors'] = $errors;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<?php include $root_path . "/includes.php";?>
    <title><?php echo $pageTitle;?></title>
      <style>
          .my-read-only-class 
            {   
              pointer-events: none;
               cursor: not-allowed;
            }
      </style>
  </head>
  <body class="hold-transition sidebar-mini">
	<div class="wrapper">
        <!--sidebar-->
		<?php include $root_path . "/sidebar.php"; ?>
		<div class="content-wrapper">
			<div class="content">
<!--Signup-->
<!--<div class="mask d-flex align-items-center h-100 gradient-custom-3">-->  
  <div class="container-fluid">
    <div class="row">
      <div class="col-6 offset-2 rounded mt-2">
          
          <div class="card card-success">
              <div class="card-header">
             <h2 class="card-title text-center"><?php echo $pageTitle;?></h2>
            </div>
         
              <div class="card-body">
            <form class="form" method="post">

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
			  	<input type="tel" pattern="[0-9]{7}|[0-9]{11}" maxlength="11" name="contact_number" id="contact_number" class="form-control form-control-lg" value="<?php echo isset($form_values['contact_number']) ? $form_values['contact_number'] : ''; ?>" />
                <label class="form-label" for="contact_number">Contact Number</label>
              </div>

              <div class="form-outline mb-4">
			  	<input type="password" name="password" class="form-control form-control-lg" value="<?php echo isset($form_values['password']) ? $form_values['password'] : ''; ?>" required />
                <label class="form-label" for="form3Example6cdg">Password*</label>
              </div>

			<div class="form-outline mb-4">
				<input type="password" name="confirm_password" class="form-control form-control-lg" value="<?php echo isset($form_values['confirm_password']) ? $form_values['confirm_password'] : ''; ?>" required />
				<label class="form-label" for="form3Example6cdg">Confirm Password*</label>
			</div>

                <div class="form-group">
                    <label for="user_type">User Type</label>
                    <select class="form-control mb-2" id="user_type" name="user_type" aria-label="User Type">                      
                        <option <?php if (isset($form_values['user_type']) && $form_values['user_type'] == 'system') {echo 'selected';} ?> value="system">System</option>
                        <option <?php if (!isset($form_values['user_type']) || $form_values['user_type'] == 'user') {echo 'selected';} ?> value="user">User</option>
                        <option <?php if (isset($form_values['user_type']) && $form_values['user_type'] == 'admin') {echo 'selected';} ?> value="admin">Admin</option>
                        <option <?php if (isset($form_values['user_type']) && $form_values['user_type'] == 'admin2') {echo 'selected';} ?> value="admin2">Admin2</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="active_select">Active</label>
                    <select class="form-control mb-2" id="active_select" name="active" aria-label="Active" <?php if (isset($form_values['user_type']) && ($form_values['user_type'] == 'system')) {echo 'readonly';} ?> >
                        <option <?php if (isset($form_values['active']) && $form_values['active'] == 1) {echo 'selected';} ?> value="1">Activated</option>
                        <?php						
                            if(isset($form_values['active']) && $form_values['active'] == 0 && $form_values['user_type'] != 'system'){
								echo '<option selected value="0">Deactivated</option>';
							}
                            else{
                                echo '<option value="0">Deactivated</option>';
							}
					    ?>
                    </select>
                </div>

              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-white"><?php if($typeOfEdit == 'New'){echo 'Create user';}else{echo 'Update user';} ?></button>
              </div>
            </form>
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
      <script>
          $(function () {
              let user_type = $('#user_type').val();
              const select = document.querySelector('#active_select');

              if (user_type == 'system') {
                select.value = '1';
                  $(select).attr('readonly', 'readonly');
                  $(select).toggleClass('my-read-only-class', true);
              }


              $('#user_type').on('change', function () {
                  let val = $(this).val();
                  console.log(val);                  
                  if (val == 'system') {

                      select.value = '1';
                      $(select).attr('readonly', 'readonly');
                      $(select).toggleClass('my-read-only-class', true);
                  }
                  else {
                      $(select).removeAttr('readonly');
                      $(select).toggleClass('my-read-only-class', false);
                  }
              });
          });
      </script>
<!--</div>-->
  	
  </body>
</html>