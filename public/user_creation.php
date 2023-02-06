<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>User Creation</title>
  </head>
  <body style="background-color:	#8B0000">
     <!--sidebar--> 
     <div class="d-flex flex-column flex-shrink-0 p-3"  style=" width: 280px; background-color: #ffd700">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Welcome!</span>
      </a>
      <form class="search" action="search.php" method="post">
        <input type="text" name="searchTerm" placeholder="Search here..." required>
        <input type="submit" value="Search">
      </form>  
      
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="#" class="nav-link link-dark">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            Home/Dashboard
          </a>
        </li>
        <li>
          <a href="#" class="nav-link active" aria-current="page">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            Sign Up
          </a>
        </li>
        <li>
          <a href="#" class="nav-link link-dark">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
            Login
          </a>
        </li>
        <li>
          <a href="#" class="nav-link link-dark">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            Report
          </a>
        <li>
          <a href="#" class="nav-link link-dark">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            View Files
          </a>
        </li>
        <li>
          <a href="#" class="nav-link link-dark">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
            Upload Files
          </a>
        </li>
        <li>
          <a href="#" class="nav-link link-dark">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
            Logout
          </a>
        </li>
      </ul>
      <hr>
          <img src="Profile Pic.jpg" alt="Profile" width="32" height="32" class="rounded-circle me-2">
<!--unique username display-->
          <strong><?php
            $username = $_GET['username'];
            echo "Username: " . $username;?>
          </strong>
    </div>
<!--Signup-->
<div class="mask d-flex align-items-center h-100 gradient-custom-3">  
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6 mx-auto">
        <div class="card" style="border-radius: 15px; background-color: #ffd700; position: relative; top:-390px; left:0; right:0;">
          <div class="card-body p-5">
            <h2 class="text-uppercase text-center mb-5">Create an Account</h2>
            <form>
              <div class="form-outline mb-4">
                <input type="text" id="form3Example1cg" class="form-control form-control-lg" />
                <label class="form-label" for="form3Example1cg">Username</label>
              </div>

              <div class="form-outline mb-4">
                <input type="text" id="form3Example2cg" class="form-control form-control-lg" />
                <label class="form-label" for="form3Example2cg">First Name</label>
              </div>

              <div class="form-outline mb-4">
                <input type="text" id="form3Example3cg" class="form-control form-control-lg" />
                <label class="form-label" for="form3Example3cg">Last Name</label>
              </div>

              <div class="form-outline mb-4">
                <input type="email" id="form3Example4cg" class="form-control form-control-lg" />
                <label class="form-label" for="form3Example4cg">Email Address</label>
              </div>

              <div class="form-outline mb-4">
                <input type="number" id="form3Example5cg" class="form-control form-control-lg" />
                <label class="form-label" for="form3Example5cg">Contact Number</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="form3Example6cdg" class="form-control form-control-lg" />
                <label class="form-label" for="form3Example6cdg">Password</label>
              </div>

              <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Confirm</button>
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