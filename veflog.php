<?php
session_start();

echo "<h2>Session Information</h2>";
if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
    echo "User ID (Session): " . htmlspecialchars($_SESSION['user_id']) . "<br>";
    echo "Email (Session): " . htmlspecialchars($_SESSION['email']) . "<br>";
    echo "Admin (Session): " . htmlspecialchars($_SESSION['admin']) . "<br>";
    echo "Loggedin variable (Session): " . htmlspecialchars($_SESSION['loggedin']) . "<br>";
} else {
    echo "No session user is logged in.<br>";
}

echo "<h2>Cookie Information</h2>";
if(isset($_COOKIE['ip'])) {
echo "User IP (Cookie) : " . htmlspecialchars($_COOKIE['ip']) . "<br>";
}
if (isset($_COOKIE['user_id']) && isset($_COOKIE['email'])) {
    echo "User ID (Cookie): " . htmlspecialchars($_COOKIE['user_id']) . "<br>";
    echo "Email (Cookie): " . htmlspecialchars($_COOKIE['email']) . "<br>";
} else {
    echo "No user ID or email found in cookies.<br>";
}
?>
