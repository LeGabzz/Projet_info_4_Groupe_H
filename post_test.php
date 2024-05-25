<?php
echo "Request method: " . $_SERVER['REQUEST_METHOD'] . "<br>";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "POST data received.<br>";
    echo "Email: " . $_POST['email'] . "<br>";
    echo "Password: " . $_POST['password'] . "<br>";
} else {
    echo "No POST data received.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test POST</title>
</head>
<body>
    <form method="POST" action="test_post.php">
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
