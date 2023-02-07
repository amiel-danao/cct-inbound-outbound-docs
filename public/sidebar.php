<?php

require_once $root_path . '/models/User.php';
$user = unserialize($_SESSION["user"]);
?>
<div class="col-2 bg-warning">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Welcome!</span>
      </a>
      <hr>
<ul class="nav nav-pills flex-column mb-auto">
	
    <li class="nav-item">
		<a href="<?php 
				 if ($user->userType == 'admin'){ 
					 echo $public_path. '/admin/dashboard.php';
				 } else {
					 echo 'dashboard.php';
				 } ?>"
			class="nav-link link-dark <?php if (basename($_SERVER['REQUEST_URI']) == 'dashboard.php') echo 'active'; ?>" aria-current="page">
			<svg class="bi pe-none me-2" width="16" height="16">
				<use xlink:href="#speedometer2"></use>
			</svg> Dashboard
		</a>
    </li>
	<?php
				 if ($user->userType == 'admin'){?>
	<li>
		<a href="<?php echo $public_path;?>/admin/users.php" class="nav-link link-dark <?php if (basename($_SERVER['REQUEST_URI']) == 'users.php') echo 'active'; ?>">
			<svg class="bi pe-none me-2" width="16" height="16">
				<use xlink:href="#speedometer2"></use>
			</svg> Users
		</a>
	</li>

	<?php }?>
	<li>
		<a href="<?php echo $public_path;?>/report_management.php" class="nav-link link-dark <?php if (basename($_SERVER['REQUEST_URI']) == 'report_management.php') echo 'active'; ?>">
			<svg class="bi pe-none me-2" width="16" height="16">
				<use xlink:href="#speedometer2"></use>
			</svg> Report
		</a>
	</li>
    <li>
		<a href="<?php echo $public_path;?>/docu_management.php" class="nav-link link-dark <?php if (basename($_SERVER['REQUEST_URI']) == 'docu_management.php') echo 'active'; ?>">
			<svg class="bi pe-none me-2" width="16" height="16">
				<use xlink:href="#speedometer2"></use>
			</svg> View Files
		</a>
    </li>
    <li>
		<a href="<?php echo $public_path;?>/docu_upload.php" class="nav-link link-dark <?php if (basename($_SERVER['REQUEST_URI']) == 'docu_upload.php') echo 'active'; ?>">
			<svg class="bi pe-none me-2" width="16" height="16">
				<use xlink:href="#grid"></use>
			</svg> Upload Files
		</a>
    </li>
    <li>        
		<a href="<?php echo $public_path;?>/logout.php" class="nav-link link-dark">
			<svg class="bi pe-none me-2" width="16" height="16">
				<use xlink:href="#people-circle"></use>
			</svg> Logout
		</a>
    </li>
</ul>
<hr>
    <img src="http://localhost/cct-inbound-outbound-docs/public/Profile Pic.jpg" alt="Profile" width="32" height="32" class="rounded-circle me-2">
    <!--unique username display-->
    <strong> 
		<?php
        echo $user->username;
		?> 
	</strong>
</div>