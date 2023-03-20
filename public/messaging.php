<?php

        $has_errors = false;
        $has_messages = false;

	  //  echo '<div aria-live="polite" aria-atomic="true" class="position-relative">';
	  //  echo '<div class="toast-container top-0 end-0 p-3">';

	  //  if(isset($_SESSION['messages'])) {
	  //	  $messages = $_SESSION['messages'];
	  //	  foreach ($messages as $message) {
	  //		  echo '
	  //	  <div id="liveToast" class="toast align-items-center text-bg-white border-0" role="alert" aria-live="assertive" aria-atomic="true">
	  //		  <div class="d-flex">
	  //		  <div class="toast-body">
	  //			  '. $message .'
	  //		  </div>
	  //		  <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
	  //		  </div>
	  //	  </div>';

	  //	  }
	  //	  $has_messages = true;
	  //	  unset($_SESSION['messages']);
	  //  }




	  //echo '</div>';
	  //echo '</div>';

	echo '<script>
		$(function () {';
	if(isset($_SESSION['messages'])) {
		$messages = $_SESSION['messages'];
		foreach ($messages as $message) {
			echo 'toastr.info("'.$message.'", "", {"closeButton": true});';

		}
		$has_errors = true;
		unset($_SESSION['errors']);
	}
	echo '});</script>';

      echo '<script>
			$(function () {';
			  if(isset($_SESSION['errors'])) {
					  $errors = $_SESSION['errors'];
					foreach ($errors as $error) {
						echo 'toastr.error("'.$error.'", "Error", {"closeButton": true});';

					}
					$has_errors = true;
					unset($_SESSION['errors']);
				}
      echo '});</script>';
?>
