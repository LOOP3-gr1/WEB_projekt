<?php
require_once('includes/header.php');
session_unset();
session_destroy();
?>

<div class="container">
	<p class='intro text-secondary t15'>You are now logged out.</p>
	<?php 
	header("Refresh:1; url=index.php");
	?>
</div>

<?php
require_once('includes/footer.php');
?>