<?php

$search_term = '';
if (isset($_POST['search_terms'])){
	$search_term = $_POST['search_terms'];
}


echo
'<form class="form m-2 w-50" action="" method="post">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="search_terms" placeholder="Enter search terms" aria-describedby="button-addon2" value="'. $search_term .'">

		  <button type="submit" class="btn btn-primary" id="button-addon2">
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
		  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
		</svg>
		Search</button>
	</div>
</form>';

?>