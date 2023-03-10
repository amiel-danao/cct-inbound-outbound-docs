<?php
session_start();
include "session_checker.php";
$root_path = $_SESSION['root_path'];
$public_path = $_SESSION['public_path'];
include $root_path . '/db_connect.php';
?>


<?php
require_once $root_path . '/models/User.php';
$user = unserialize($_SESSION["user"]);

$query = "SELECT username FROM users WHERE user_type != 'system' AND id != $user->id";

$options = array();
$stmt = $pdo->query($query);
while ($row = $stmt->fetch()) {
	$options[$row['username']] = $row['username'];
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $errors = array();
    $messages = array();
	// Get the form data
	$file_name = $_POST['file_name'];
	$send_to = $_POST['send_to'];
	$file = $_FILES['file'];
    $document_type = $_POST['document_type'];

	// File upload validation
	$allowed_types = ['.docx', '.doc', '.pptx', '.ppt', '.xlsx', '.xls', '.pdf', '.odt', '.jpg'];
	$file_type = "." . strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
	if (!in_array($file_type, $allowed_types)) {
		// Show error message for invalid file type
		$errors[] = 'Invalid file type: ' . $file_type;
        goto end;
	}

	// Store the file
    $uploaddir = $root_path . '/uploads/' . $user->id;
    if (!file_exists($uploaddir)) {
		mkdir($uploaddir, 0777, true);
	}

	$file_path = $uploaddir . $file['name'];
    $uploaded_path = '/uploads/' . $user->id . $file['name'];
    if (!is_dir($uploaddir) && !mkdir($uploaddir)){
		$errors[] = "Error creating folder $uploaddir";
        goto end;
	}


	if (move_uploaded_file($file['tmp_name'], $file_path)){
        $status = 'pending';
        if ($document_type == 'Personal'){
            $status = 'approved';
		}
		// Insert a new row into the documents table
		$date_upload = date('Y-m-d H:i:s');

        try {
			// set the PDO error mode to exception
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// begin the transaction
			$pdo->beginTransaction();
			// our SQL statements

			foreach ($send_to as $receiver) {
				$sql = "INSERT INTO documents (file_name, file_path, send_to, date_upload, document_type, uploaded_by, status)
                        VALUES ('$file_name', '$uploaded_path', '$receiver', '$date_upload', '$document_type', '$user->username', '$status')";
			
                $pdo->exec($sql);
			}

			// commit the transaction
			$pdo->commit();
			$messages[] = "Document uploaded successfully successfully";
            $_SESSION['messages'] = $messages;
            header("Location:" . $public_path . "/sent_page.php");
            exit();
		}
		catch(PDOException $e) {
			// roll back the transaction if something failed
			$pdo->rollback();
			$errors[] = "Error: " . $e->getMessage();
            goto end;
		}
	}
    else{
        $errors[] = "Error uploading the file, please try again later.";
	}

    end:
    $_SESSION['messages'] = $messages;
    $_SESSION['errors'] = $errors;
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
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
  	<?php include $root_path . "/includes.php";?>
      <?php echo '<link href="'.$public_path.'/css/multi-select.css" rel="stylesheet" />';?>
    <title>Document Upload</title>
  </head>
  <body style="background-color:	#8B0000">
  	<?php include $root_path . "/messaging.php" ?>
  	<div class="container-fluid">
  		<div class="row">
  			<!--sidebar-->
  			<?php include "sidebar.php"; ?>
  			<!--upload details-->


  			<div class="col-4 offset-2 mt-2">
  				<div class="card rounded bg-warning">
  					<div class="card-body">
  						<h2 class="text-uppercase text-center mb-5">Upload a File</h2>
  						<form method="post" enctype="multipart/form-data">
  							<div class="form-outline mb-4">
  								<input type="text" name="file_name" id="file_name" class="form-control form-control-lg" required />
  								<label class="form-label" for="file_name">File Name</label>
  							</div>

  							<script type="text/javascript">
                              $(document).ready(function(){
                                 $("#file").change(function(){
                                    var fileName = $(this).val();
                                    $("#noFile").text(fileName);
                                 });
                              });
  							</script>

  							<div class="file-upload mb-3">
  								<div class="file-select">
  									<div class="file-select-button" id="fileName">Choose File</div>
  									<div class="file-select-name" id="noFile">No file chosen...</div>
								  	<input type="file" name="file" id="file" accept=".docx,.doc,.pptx,.ppt,.xlsx,.xls,.pdf,.odt, .jpg" required />
  								</div>
  							</div>

                              <div class="form-group mb-2">                                
                                <select class="form-control" name="document_type" required>
                                    <option value="Personal">Personal</option>
                                    <option value="Non-Personal">Non-Personal</option>
                                </select>
                                  <label for="file_type">Document Type</label>
                                </div>

  							<!--<div class="form-outline mb-4">
  								<input type="text" name="send_to" id="send_to" class="form-control form-control-lg" title="Type in the user receiver's username" placeholder="type in receiver's username" required />
  								<label class="form-label" for="send_to">Send To</label>
  							</div>-->

                              <label class="form-label" for="send_to">Send To</label>
                            <select multiple="multiple" class="mb-2" id="send_to" name="send_to[]" required>

                                <?php foreach ($options as $username => $username) { ?>
                                    <option value="<?php echo $username; ?>"><?php echo $username; ?></option>
                                  <?php } ?>
                            </select>
                              <button id="send_to_all" type="button" class="btn btn-light text-black mb-2">Select All</button>
                              <button id="deselect_all" type="button" class="btn btn-light text-black mb-2">Deselect All</button>
                              <br>
  							<button type="submit" name="submit" class="btn btn-success text-white">Upload</button>
  						</form>
  					</div>
  				</div>
  			</div>

  		</div>
  	</div>

      <script src="js/jquery.multi-select.js" type="text/javascript"></script>
      <script>
          $('#send_to').multiSelect();

          $('#send_to_all').on('click', function () {
              $('#send_to').multiSelect('select_all');
          });

          $('#deselect_all').on('click', function () {
              $('#send_to').multiSelect('deselect_all');
          });
          
      </script>
  </body>
    
</html>