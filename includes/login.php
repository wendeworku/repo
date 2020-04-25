<?php
global $connect, $lang;
$documnetRootPath = $_SERVER['DOCUMENT_ROOT'];
$errorShow = "";
if (isset($_GET['lan'])) {
    $lang_url = "?&lan=" . $_GET['lan'];
} else {
    $lang_url = "";
}

require_once $documnetRootPath . '/includes/headerSearchAndFooter.php';
require_once $documnetRootPath . '/includes/cmn.user.php';
require_once $documnetRootPath . '/classes/cmn.class.php';
require_once $documnetRootPath . '/db/database.class.php';

$documnetRootPath = $_SERVER['DOCUMENT_ROOT'];
require_once $documnetRootPath . '/includes/headerSearchAndFooter.php';
require_once $documnetRootPath . '/classes/reflection/HtUserAll.php';
require_once $documnetRootPath . '/includes/validate.php';


if (isset($_POST['submit'])) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    $result2 = userLogin($_POST['email'], $_POST['password']);

    if ($result2 == "LOGIN_SUCCESS") {
        header("Location:../../includes/mypage.php" . $login_url . "");
    } else {
        $errorShow = $result2;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Log In | ይግቡ </title>
    <?php commonHeader(); ?>
    <link href="../../css/hulutera.unminified.css" rel="stylesheet">
	<link href="../../css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
	.alert-custom {
    color: #a94442;
}
</style>
<body>
    <div id="whole">
        <div id="wrapper">
            <?php headerAndSearchCode(""); ?>
            <div id="main_section">

                <?php
                ///reset/cleanup session variables
                if (!isset($_GET['function']) or $_GET['function'] !== 'login' or $_SESSION['lan'] != $_GET['lan']) {
                    unset($_SESSION['POST']);
                    unset($_SESSION['errorRaw']);
                }
                $_SESSION['lan'] = isset($_GET['lan']) ? $_GET['lan'] : "en";
                $sessionName = 'login';
                $_SESSION['previous'] = basename($_SERVER['PHP_SELF']);

                if (!isset($_SESSION[$sessionName])) {
                    $object = new HtUserAll("*");
                    $object->login();
                    $_SESSION[$sessionName] = base64_encode(serialize($object));
                } else {
                    $object = unserialize(base64_decode($_SESSION[$sessionName]));
                    $object->login();
                }
                var_dump($_SESSION);
                ?>                
            </div>
        </div>
        <div class="push"></div>
    </div>
    <?php footerCode(); ?>
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