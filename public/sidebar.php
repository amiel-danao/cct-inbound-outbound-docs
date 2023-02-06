<div class="d-flex flex-column flex-shrink-0 p-3" style=" width: 280px; background-color: #ffd700">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Welcome!</span>
      </a>
      <hr>
<ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
        <a href="dashboard.php" class="nav-link active" aria-current="page">
        <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#speedometer2"></use>
        </svg> Dashboard </a>
    </li>
    <!-- <li><a href="#" class="nav-link link-dark"><svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
        Sign Up
        </a></li><li><a href="#" class="nav-link link-dark"><svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
        Login
        </a></li> -->
    <li>
        <a href="report_management.php" class="nav-link link-dark">
        <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#speedometer2"></use>
        </svg> Report </a>
    <li>
        <a href="docu_management.php" class="nav-link link-dark">
        <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#speedometer2"></use>
        </svg> View Files </a>
    </li>
    <li>
        <a href="docu_upload.php" class="nav-link link-dark">
        <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#grid"></use>
        </svg> Upload Files </a>
    </li>
    <li>        
        <a href="?logout=1" class="nav-link link-dark">
        <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#people-circle"></use>
        </svg> Logout </a>
    </li>
</ul>
<hr>
    <img src="Profile Pic.jpg" alt="Profile" width="32" height="32" class="rounded-circle me-2">
    <!--unique username display-->
    <strong> 
    <?php
        $email = $_SESSION["email"];
        echo $email;
    ?> </strong>
</div>