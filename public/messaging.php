<?php

          echo '<div aria-live="polite" aria-atomic="true" class="position-relative">';
		  echo '<div class="toast-container top-0 end-0 p-3">';

		  if(isset($_SESSION['messages'])) {
			  $messages = $_SESSION['messages'];
			  foreach ($messages as $message) {
				  echo '
                <div id="liveToast" class="toast align-items-center text-bg-white border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                    <div class="toast-body">
                        '. $message .'
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>';

			  }
			  unset($_SESSION['messages']);
		  }


        if(isset($_SESSION['errors'])) {
			  $errors = $_SESSION['errors'];
            foreach ($errors as $error) {
                    echo '
                <div id="liveToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                    <div class="toast-body">
                        '. $error .'
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>';

            }
            unset($_SESSION['errors']);
	    }

      echo '</div>';
      echo '</div>';

      echo "<script>
            const toastLiveExample = document.getElementById('liveToast');
            const toast = new bootstrap.Toast(toastLiveExample);
            toast.show();
        </script>";


?>
