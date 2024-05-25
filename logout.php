<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>
        alert('Vous n'êtes pas connecté !');
        window.location.href = 'logt.php';
    </script>";
}

// Unset all of the session variables
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Clear the user ID and email cookies
setcookie('user_id', '', time() - 3600, "/");
setcookie('email', '', time() - 3600, "/");
setcookie('ip', '', time() - 3600, "/");

// Redirect to login page or a confirmation page
    echo "<script>
        alert('Vous êtes déconnecté');
        window.location.href = 'logt.php';
    </script>";
header('Location: /');
exit();
?>
