<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/headerSearchAndFooter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/validate.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $GLOBALS['user_specific_array']['user']['login']; ?></title>
    <?php commonHeader(); ?>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/hulutera.unminified.css" rel="stylesheet">
    <link href="../../css/font-awesome.min.css" rel="stylesheet">

</head>
<style>
    .alert-custom {
        color: #a94442;
    }
</style>

<body>
    <?php
    if (!isset($_GET['release'])) {
        headerAndSearchCode("");
    }
    ?>
    <script>
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
      }
    </script>
    <div class="row">

        <?php
        ///reset/cleanup session variables
        if (!isset($_GET['function']) or $_GET['function'] !== 'login' or $_SESSION['lan'] != $_GET['lan']) {
            unset($_SESSION['POST']);
            unset($_SESSION['errorRaw']);
        }
        $sessionName = 'login';
        $_SESSION['previous'] = basename($_SERVER['PHP_SELF']);
        $_SESSION['lan'] = isset($_GET['lan']) ? $_GET['lan'] : "en";

        if (!isset($_SESSION[$sessionName])) {
            $object = new HtUserAll("*");
            $object->login();
            $_SESSION[$sessionName] = base64_encode(serialize($object));
        } else {
            $object = unserialize(base64_decode($_SESSION[$sessionName]));
            $object->login();
        }
        ?>
    </div>
    <?php
    if (!isset($_GET['release'])) {
        footerCode();
    }
    ?>
    <script>
        function showPassword() {
            var x1 = document.getElementById("fieldPassword");
            var x2 = document.getElementById("fieldPasswordRepeat");
            x1.type = (x1.type === "password") ? "text" : "password";
            x2.type = (x2.type === "password") ? "text" : "password";
        }
    </script>
</body>

</html>