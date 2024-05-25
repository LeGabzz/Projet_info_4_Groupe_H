<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>
        alert('Vous devez être connecté pour performer cette action !');
        window.location.href = 'logt.php';
    </script>";
    exit;
}
if($_SESSION['admin'] !== true) {
    echo "<script>
        alert('Vous devez être administrateur pour performer cette action !');
        window.location.href = 'logt.php';
    </script>";
    exit;
}
// Database connection
$db = new SQLite3('my_database2.db');

// Handle actions (modify reqs, delete user, send email, reset content)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['modify_reqs'])) {
        $user_id = $_POST['user_id'];
        $new_reqs = $_POST['new_reqs'];
        $stmt = $db->prepare("UPDATE users SET reqs = ? WHERE id = ?");
        $stmt->bindValue(1, $new_reqs, SQLITE3_INTEGER);
        $stmt->bindValue(2, $user_id, SQLITE3_INTEGER);
        $stmt->execute();
    } elseif (isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bindValue(1, $user_id, SQLITE3_INTEGER);
        $stmt->execute();
        unlink("user_{$user_id}_recipes.json");
        unlink("user_{$user_id}_favs.json");
    } elseif (isset($_POST['reset_content'])) {
        $user_id = $_POST['user_id'];
        file_put_contents("user_{$user_id}_recipes.json", '');
        file_put_contents("user_{$user_id}_favs.json", '');
    } elseif (isset($_POST['send_email'])) {
        $user_email = $_POST['user_email'];
        $email_subject = $_POST['email_subject'];
        $email_message = $_POST['email_message'];
        mail($user_email, $email_subject, $email_message);
    }
}

// Fetch users and total requests
$users = $db->query("SELECT * FROM users");
$total_requests_result = $db->query("SELECT SUM(reqs) AS total_requests FROM users");
$total_requests = $total_requests_result->fetchArray(SQLITE3_ASSOC)['total_requests'];
$total_users_result = $db->query("SELECT COUNT(*) AS total_users FROM users");
$total_users = $total_users_result->fetchArray(SQLITE3_ASSOC)['total_users'];

// Fetch support messages
$support_messages = $db->query("SELECT sm.*, u.email FROM support_messages sm JOIN users u ON sm.user_id = u.id ORDER BY sm.created_at DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding-top: 70px;
        }

        .admin-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
        }

        h1, h2 {
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"],
        input[type="number"],
        textarea {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        button[type="submit"],
        .action-button {
            padding: 10px;
            border: none;
            background-color: black;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px; /* Add margin to separate buttons */
        }

        button[type="submit"]:hover,
        .action-button:hover {
            background-color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .support-messages {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: #fff;
            max-height: 300px;
            overflow-y: scroll;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Admin Panel</h1>
        modif header / ajt titres / page param / bind chatbot / serveur smtp / ajt bouton email oublié // généraliser header
        <div class="actions">
            <a href="initialize_db2.php" class="action-button">Initialize DB</a>
            <a href="deldb2.php" class="action-button">Delete DB</a>
            <a href="dbcheck3.php" class="action-button">Print DB</a>
            <a href="dbcheck2.php" class="action-button">Print DB BASE</a>
        </div>

        <!-- Your existing forms and content here -->
        <form method="post">
            <h2>Modify User Requests</h2>
            <label for="user_id">User ID:</label>
            <input type="number" id="user_id" name="user_id" required>
            <label for="new_reqs">New Requests:</label>
            <input type="number" id="new_reqs" name="new_reqs" required>
            <button type="submit" name="modify_reqs">Modify</button>
        </form>

        <form method="post">
            <h2>Delete User</h2>
            <label for="user_id">User ID:</label>
            <input type="number" id="user_id" name="user_id" required>
            <button type="submit" name="delete_user">Delete</button>
        </form>

        <form method="post">
            <h2>Reset User Content</h2>
            <label for="user_id">User ID:</label>
            <input type="number" id="user_id" name="user_id" required>
            <button type="submit" name="reset_content">Reset</button>
        </form>

        <form method="post">
            <h2>Send Email</h2>
            <label for="user_email">User Email:</label>
            <input type="email" id="user_email" name="user_email" required>
            <label for="email_subject">Subject:</label>
            <input type="text" id="email_subject" name="email_subject" required>
            <label for="email_message">Message:</label>
            <textarea id="email_message" name="email_message" required></textarea>
            <button type="submit" name="send_email">Send</button>
        </form>

        <h2>Support Messages</h2>
        <div class="support-messages">
            <?php
            while ($message = $support_messages->fetchArray(SQLITE3_ASSOC)) {
                echo "<p><strong>{$message['email']}</strong> ({$message['created_at']}): {$message['message']}</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
