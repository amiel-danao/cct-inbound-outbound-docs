<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Docu Upload</title>
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
          <a href="#" class="nav-link link-dark">
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
          <a href="#" class="nav-link active" aria-current="page">
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
<!--report details-->
<form class="search" action="search.php" method="post" style="position: relative; top: -440px; left:700px;">
  <input type="text" name="searchTerm" placeholder="Search here..." required>
  <input type="submit" value="Search">
</form>  

  <section class="ftco-section">
    <div class="container" style="background-color: white; width: 50%; position: relative; top:-425px; left:0; right:0;">
    <div class="row">
    <div class="col-md-12">
    <div class="table-wrap">
    <table class="table">
    <thead class="thead-primary">
    <tr>
    <th>#</th>
    <th>File Name</th>
    <th>Sent By</th>
    <th>Upload Date</th>
    <th>Status</th>
    <th>Download Link</th>
    </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $fileName; ?></td>
        <td><?php echo $sentBy; ?></td>
        <td><?php echo $uploadDate; ?></td>
        <td><?php echo $status; ?></td>
        <td><a href="<?php echo $downloadLink; ?>">Download</a></td>
      </tr>
  
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $fileName; ?></td>
        <td><?php echo $sentBy; ?></td>
        <td><?php echo $uploadDate; ?></td>
        <td><?php echo $status; ?></td>
        <td><a href="<?php echo $downloadLink; ?>">Download</a></td>
      </tr>
  
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $fileName; ?></td>
        <td><?php echo $sentBy; ?></td>
        <td><?php echo $uploadDate; ?></td>
        <td><?php echo $status; ?></td>
        <td><a href="<?php echo $downloadLink; ?>">Download</a></td>
      </tr>
  
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $fileName; ?></td>
        <td><?php echo $sentBy; ?></td>
        <td><?php echo $uploadDate; ?></td>
        <td><?php echo $status; ?></td>
        <td><a href="<?php echo $downloadLink; ?>">Download</a></td>
      </tr>
  
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $fileName; ?></td>
        <td><?php echo $sentBy; ?></td>
        <td><?php echo $uploadDate; ?></td>
        <td><?php echo $status; ?></td>
        <td><a href="<?php echo $downloadLink; ?>">Download</a></td>
      </tr>
  
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $fileName; ?></td>
        <td><?php echo $sentBy; ?></td>
        <td><?php echo $uploadDate; ?></td>
        <td><?php echo $status; ?></td>
        <td><a href="<?php echo $downloadLink; ?>">Download</a></td>
      </tr>
  
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $fileName; ?></td>
        <td><?php echo $sentBy; ?></td>
        <td><?php echo $uploadDate; ?></td>
        <td><?php echo $status; ?></td>
        <td><a href="<?php echo $downloadLink; ?>">Download</a></td>
      </tr>
  
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $fileName; ?></td>
        <td><?php echo $sentBy; ?></td>
        <td><?php echo $uploadDate; ?></td>
        <td><?php echo $status; ?></td>
        <td><a href="<?php echo $downloadLink; ?>">Download</a></td>
      </tr>
  
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $fileName; ?></td>
        <td><?php echo $sentBy; ?></td>
        <td><?php echo $uploadDate; ?></td>
        <td><?php echo $status; ?></td>
        <td><a href="<?php echo $downloadLink; ?>">Download</a></td>
      </tr>
  
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $fileName; ?></td>
        <td><?php echo $sentBy; ?></td>
        <td><?php echo $uploadDate; ?></td>
        <td><?php echo $status; ?></td>
        <td><a href="<?php echo $downloadLink; ?>">Download</a></td>
      </tr>
  
    </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
      <button class="btn btn-light mx-2" id="page1">1</button>
      <button class="btn btn-light mx-2" id="page2">2</button>
      <button class="btn btn-light mx-2" id="page3">3</button>
      <button class="btn btn-light mx-2" id="page4">4</button>
      <button class="btn btn-light mx-2" id="page5">5</button>
    </div>
    </div>
    </div>
    </div>
    </div>
    </section>
  </body>
</html>