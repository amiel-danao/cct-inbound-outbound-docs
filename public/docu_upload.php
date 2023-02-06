<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="style.css">
    <style>
      .file-upload{display:block;text-align:center;font-family: Helvetica, Arial, sans-serif;font-size: 12px;}
.file-upload .file-select{display:block;border: 2px solid #dce4ec;color: #34495e;cursor:pointer;height:40px;line-height:40px;text-align:left;background:#FFFFFF;overflow:hidden;position:relative;}
.file-upload .file-select .file-select-button{background:#dce4ec;padding:0 10px;display:inline-block;height:40px;line-height:40px;}
.file-upload .file-select .file-select-name{line-height:40px;display:inline-block;padding:0 10px;}
.file-upload .file-select:hover{border-color:#34495e;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
.file-upload .file-select:hover .file-select-button{background:#34495e;color:#FFFFFF;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
.file-upload.active .file-select{border-color:#3fa46a;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
.file-upload.active .file-select .file-select-button{background:#3fa46a;color:#FFFFFF;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
.file-upload .file-select input[type=file]{z-index:100;cursor:pointer;position:absolute;height:100%;width:100%;top:0;left:0;opacity:0;filter:alpha(opacity=0);}
.file-upload .file-select.file-select-disabled{opacity:0.65;}
.file-upload .file-select.file-select-disabled:hover{cursor:default;display:block;border: 2px solid #dce4ec;color: #34495e;cursor:pointer;height:40px;line-height:40px;margin-top:5px;text-align:left;background:#FFFFFF;overflow:hidden;position:relative;}
.file-upload .file-select.file-select-disabled:hover .file-select-button{background:#dce4ec;color:#666666;padding:0 10px;display:inline-block;height:40px;line-height:40px;}
.file-upload .file-select.file-select-disabled:hover .file-select-name{line-height:40px;display:inline-block;padding:0 10px;}
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
      <form class="search" action="">
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
            <a href="#" class="nav-link active" aria-current="page">
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
<!--upload details-->
<?php
if (isset($_POST['submit'])) {
  $fileName = $_POST['fileName'];
  $sentTo = $_POST['sentTo'];
  
  // code to handle file upload
  $file = $_FILES['chooseFile']['tmp_name'];
  $destination = "/path/to/destination/" . $fileName;
  move_uploaded_file($file, $destination);

  // code to send the file
  // ...
  
  echo "File '$fileName' has been uploaded and sent to '$sentTo'";
}
?>
<div class="mask d-flex align-items-center h-100 gradient-custom-3">  
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6 mx-auto">
        <div class="card" style="border-radius: 15px; background-color: #ffd700; position: relative; top:-390px; left:0; right:0;">
          <div class="card-body p-5">
            <h2 class="text-uppercase text-center mb-5">Upload a File</h2>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="form-outline mb-4">
                <input type="text" name="fileName" class="form-control form-control-lg" required />
                <label class="form-label" for="form3Example1cg">File Name</label>
              </div>

              <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
              <script type="text/javascript">
              $(document).ready(function(){
                 $("#chooseFile").change(function(){
                    var fileName = $(this).val();
                    $("#noFile").text(fileName);
                 });
              });
              </script>
              
              <div class="file-upload">
                <div class="file-select">
                  <div class="file-select-button" id="fileName">Choose File</div>
                  <div class="file-select-name" id="noFile">No file chosen...</div> 
                  <input type="file" name="chooseFile" id="chooseFile" required />
                </div>
              </div>
              <br><br>
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="sentTo" class="form-control form-control-lg" required />
                <label class="form-label" for="form3Example1cg">Sent To</label>
              </div>
                <button type="submit" name="submit" class="button button1" style="color:black">Upload</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  </body>
</html>