<?php
  include 'db_connect.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
      die("Error executing query: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
      session_start();
      $root_path = dirname(__FILE__);
      $public_path = 'http://localhost/cct-inbound-outbound-docs/public';
      $_SESSION['root_path'] = $root_path;
      $_SESSION['public_path'] = $public_path;
      require_once $root_path . '\models\User.php';

      $row = mysqli_fetch_assoc($result);
      $user_type = $row['user_type'];
      $user = new User($row['id'], $row['username'], $row['first_name'], $row['middle_name'], $row['last_name'], $row['contact_number'], $user_type);
      $_SESSION['user'] = serialize($user);

      if ($user_type == 'admin') {

        $_SESSION['username'] = $username;
        header("location: admin/dashboard.php");
      } else {
        $_SESSION['username'] = $username;
        header("location: dashboard.php");
      }
    } else {
      echo "Invalid username or password";
    }
  }
  mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Login</title>
    <style>
      .button {
        background-color: #ffd700;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin: 4px 2px;
        cursor: pointer;
      }
      
      .button1 {font-size: 20px;}
      </style>
  </head>
<!--login details-->
  <body class="text-right;" style="background-color:	#8B0000;">
  <div class="container-fluid">
    <div class="row text-center p-5">
      
      <div class="col-6">
      <img class="mb-4 img-fluid" src="CCT.jpg" alt="">
    </div>
      <div class="col-6">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        
          <h1 class="h3 mb-3 fw-normal" style="color:white">Login</h1>
          <div class="form-floating">
            <input type="text" name="username" class="form-control" placeholder="">
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating">
            <input type="password" name="password" class="form-control" placeholder="Password" >
            <label for="floatingPassword">Password</label>
          </div>
          <button type="submit" class="button" style="color:black">Sign In</button>
      </form>
      </div>
    </div>
    </div>
   </body>
</html>