<?php
session_start();
$documnetRootPath = $_SERVER['DOCUMENT_ROOT'];
require_once $documnetRootPath . '/includes/headerSearchAndFooter.php';
require_once $documnetRootPath . '/classes/reflection/HtUserAll.php';
require_once $documnetRootPath . '/includes/validate.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Register | ይመዝገቡ</title>
	<?php commonHeader(); ?>
	<link href="../../css/hulutera.unminified.css" rel="stylesheet">
	<link href="../../css/bootstrap.min.css" rel="stylesheet">
</head>
<script>
	$(document).ready(function() {
		$('.show-password').on('change', function() { // on change of state
			if (this.checked) // if changed state is "CHECKED"
			{
				// do the magic here
				$('.fieldPassword').attr('type') = 'text';
			}
		});
	});
</script>

<body>
	<div id="whole">
		<div id="wrapper">
			<?php
			?>
			<div id="main_section">
				<?php

				///reset/cleanup session variables
				if (!isset($_GET['function']) or $_GET['function'] !== 'register' or $_SESSION['lan'] != $_GET['lan']) {
					unset($_SESSION['POST']);
					unset($_SESSION['errorRaw']);
				}
				$_SESSION['lan'] = $_GET['lan'];
				$sessionName = 'register';
				$_SESSION['previous'] = basename($_SERVER['PHP_SELF']);
				
				if (!isset($_SESSION[$sessionName])) {
					$object = new HtUserAll("*");
					$object->register();
					$_SESSION[$sessionName] = base64_encode(serialize($object));
				} else {
					$object = unserialize(base64_decode($_SESSION[$sessionName]));
					$object->register();
				}
				?> </div>
		</div>
		<div class="push"></div>
	</div>
	<?php //footerCode(); 
	?>

	<script>
		function myFunction() {
			var x1 = document.getElementById("fieldPassword");			
			var x2 = document.getElementById("fieldPasswordRepeat");
			x1.type = (x1.type === "password") ? "text" : "password";
			x2.type = (x2.type === "password") ? "text" : "password";
			
		}
	</script>
</body>

</html>