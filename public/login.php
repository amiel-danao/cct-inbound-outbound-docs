<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form data
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Check if the username and password are correct
  if ($email == "admin@admin.com" && $password == "admin") {
    // Start a session and store the email
    session_start();
    $_SESSION["email"] = $email;

    // Redirect to the protected page
    header("Location: dashboard.php");
    exit;
  } else {
    // Show an error message
    echo "Invalid email or password";
  }
}
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
            <input type="email" name="email" class="form-control" placeholder="name@example.com">
            <label for="floatingInput">Email</label>
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