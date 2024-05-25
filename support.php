<?php
session_start();

if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin'] !== true) {
    echo "<script>
        alert('Vous devez être connecté pour performer cette action !');
        window.location.href = 'logt.php';
    </script>";
}


// Database connection
$db = new SQLite3('my_database2.db');

$message_sent = false;
$user_not_found = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_message'])) {
    if (!empty($_POST['user_email']) && !empty($_POST['message'])) {
        $user_email = $_POST['user_email'];
        $message = $_POST['message'];

        // Fetch user ID based on email
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bindValue(1, $user_email, SQLITE3_TEXT);
        $result = $stmt->execute();
        $user = $result->fetchArray(SQLITE3_ASSOC);

        if ($user) {
            $user_id = $user['id'];
            $stmt = $db->prepare("INSERT INTO support_messages (user_id, message, created_at) VALUES (?, ?, ?)");
            $stmt->bindValue(1, $user_id, SQLITE3_INTEGER);
            $stmt->bindValue(2, $message, SQLITE3_TEXT);
            $stmt->bindValue(3, date('Y-m-d H:i:s'), SQLITE3_TEXT);
            $stmt->execute();
            $message_sent = true;
        } else {
            $user_not_found = true;
        }
    } else {
        echo "<script>alert('Please provide an email and message.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Support</title>
    <link rel="stylesheet" href="bande.css">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="support.css">
    <link href="https://fonts.googleapis.com/css2?family=Pinyon+Script&display=swap" rel="stylesheet">
    
</head>
<body>
    <?php include 'header_support.html'; ?>
    <div class="support-container">
        <h1>Contact Support</h1>
        <form method="post">
            <label for="user_email">Email:</label>
            <input type="email" id="user_email" name="user_email" required>
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
            <button type="submit" name="send_message">Send</button>
        </form>
    </div>

    <?php if ($message_sent): ?>
        <script>alert('Message sent to support.');</script>
    <?php elseif ($user_not_found): ?>
        <script>alert('User not found.');</script>
    <?php endif; ?>
</body>
</html>
