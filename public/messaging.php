<?php


	echo '<script>
		$(function () {';
			if(isset($_SESSION['messages'])) {
				$messages = $_SESSION['messages'];
				foreach ($messages as $message) {
					echo 'toastr.info("'.$message.'", "", {"closeButton": true});';

				}
				unset($_SESSION['messages']);
			}
	echo '});</script>';


    echo '<script>
		$(function () {';
			if(isset($_SESSION['errors'])) {
					$errors = $_SESSION['errors'];
				foreach ($errors as $error) {
					echo 'toastr.error("'.$error.'", "Error", {"closeButton": true});';

				}
				unset($_SESSION['errors']);
			}
    echo '});</script>';
?>
