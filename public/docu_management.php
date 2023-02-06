<?php
include "session_checker.php";
include "logout.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Document Management</title>
  </head>
  <body style="background-color:	#8B0000">
    <!--sidebar--> 
    <?php include "sidebar.php"; ?>
<!--Table-->    
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