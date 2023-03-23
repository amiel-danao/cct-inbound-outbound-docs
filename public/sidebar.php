<?php

require_once $root_path . '/models/User.php';
$user = unserialize($_SESSION["user"]);
?>
<nav class="main-header navbar navbar-expand navbar-light">
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#">
				<i class="fa fa-bars"></i>
			</a>
		</li>
	</ul>


</nav>


<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="/" class="brand-link">
		<img src="<?php echo $public_path; ?>\images\logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8" />
		<span class="brand-text font-weight-light">Welcome!</span>
	</a>
	<div class="sidebar">


		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<!--<div class="image">
			<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
		</div>-->
			<div class="info text-white">
				<?php
				 echo $user->username;
				?>
			</div>
		</div>
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item menu-open">

					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php 
									 if ($user->userType == 'admin' || $user->userType == 'admin2' || $user->userType == 'system'){ 
									 echo $public_path. '/admin/dashboard.php';
								 } else {
									 echo $public_path.'/dashboard.php';
								 } ?>"
								class="nav-link link-dark <?php if (basename($_SERVER['REQUEST_URI']) == 'dashboard.php') echo 'active'; ?>" aria-current="page">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer2" viewbox="0 0 16 16">
									<path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"></path>
									<path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"></path>
								</svg>
								<p>Dashboard</p>
							</a>
						</li>

						<?php if ($user->userType == 'system'){?>
						<li class="nav-item">
							<a href="<?php echo $public_path;?>/admin/users.php" class="nav-link link-dark <?php if (basename($_SERVER['REQUEST_URI']) == 'users.php') echo 'active'; ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewbox="0 0 16 16">
									<path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"></path>
								</svg>
								<p>Users</p>
							</a>
						</li>
						<?php }?>
						<?php if ($user->userType == 'admin' || $user->userType == 'admin2'){?>
						<li class="nav-item">
							<a href="<?php echo $public_path;?>/admin/pending_page.php" class="nav-link link-dark <?php if (basename($_SERVER['REQUEST_URI']) == 'pending_page.php') echo 'active'; ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewbox="0 0 16 16">
									<path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"></path>
								</svg>
								<p>
									Pending Files
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo $public_path;?>/admin/approved_page.php" class="nav-link link-dark <?php if (basename($_SERVER['REQUEST_URI']) == 'approved_page.php') echo 'active'; ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check-fill" viewbox="0 0 16 16">
									<path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zm8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"></path>
								</svg>
								<p>
									Approved Files
								</p>
							</a>
						</li>
						<?php }
						  if ($user->userType == 'user' || $user->userType == 'admin' || $user->userType == 'admin2'){?>
						<li class="nav-item">
							<a href="<?php echo $public_path;?>/docu_upload.php" class="nav-link link-dark <?php if (basename($_SERVER['REQUEST_URI']) == 'docu_upload.php') echo 'active'; ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewbox="0 0 16 16">
									<path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"></path>
									<path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"></path>
								</svg>
								<p>
									Send File
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo $public_path;?>/received_page.php" class="nav-link link-dark <?php if (basename($_SERVER['REQUEST_URI']) == 'received_page.php') echo 'active'; ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-down-right" viewbox="0 0 16 16">
									<path fill-rule="evenodd" d="M6.364 2.5a.5.5 0 0 1 .5-.5H13.5A1.5 1.5 0 0 1 15 3.5v10a1.5 1.5 0 0 1-1.5 1.5h-10A1.5 1.5 0 0 1 2 13.5V6.864a.5.5 0 1 1 1 0V13.5a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5v-10a.5.5 0 0 0-.5-.5H6.864a.5.5 0 0 1-.5-.5z"></path>
									<path fill-rule="evenodd" d="M11 10.5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1 0-1h3.793L1.146 1.854a.5.5 0 1 1 .708-.708L10 9.293V5.5a.5.5 0 0 1 1 0v5z"></path>
								</svg>
								<p>
									Received Files
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo $public_path;?>/sent_page.php" class="nav-link link-dark <?php if (basename($_SERVER['REQUEST_URI']) == 'sent_page.php') echo 'active'; ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right-square-fill" viewbox="0 0 16 16">
									<path d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12zM5.904 10.803 10 6.707v2.768a.5.5 0 0 0 1 0V5.5a.5.5 0 0 0-.5-.5H6.525a.5.5 0 1 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 .707.707z"></path>
								</svg>
								<p>
									Sent Files
								</p>
							</a>
						</li>

						<?php }?>

						<?php if ($user->userType == 'user' || $user->userType == 'admin' || $user->userType == 'admin2'){?>
						<li class="nav-item">
							<a href="<?php echo $public_path;?>/archive_page.php" class="nav-link link-dark <?php if (basename($_SERVER['REQUEST_URI']) == 'archive_page.php') echo 'active'; ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive-fill" viewbox="0 0 16 16">
									<path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z"></path>
								</svg>
								<p>
									Archived Files
								</p>
							</a>
						</li>
						<?php } ?>
						<li class="nav-item">
							<a href="<?php echo $public_path;?>/report_page.php" class="nav-link link-dark">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-break-fill" viewbox="0 0 16 16">
									<path d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V9H2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM2 12h12v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-2zM.5 10a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H.5z"></path>
								</svg>
								<p>
									Report
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo $public_path;?>/logout.php" class="nav-link link-dark">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewbox="0 0 16 16">
									<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
								</svg>
								<p>
									Logout
								</p>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</aside>

