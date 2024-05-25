<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>
        alert('Vous devez être connecté pour performer cette action !');
        window.top.location.href = 'logt.php';
    </script>";
    exit;
}

$userId = $_SESSION['user_id'];
$message = "DEMANDE AUGMENTATION LIMITE ->" . $userId;
$createdAt = date('Y-m-d H:i:s'); // Current date and time

try {
    
    $db = new SQLite3('my_database2.db');

    $db->exec('CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        age INTEGER,
        fullname TEXT,
        country TEXT,
        reqs INTEGER
    )');

    $db->exec('CREATE TABLE IF NOT EXISTS support_messages (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        message TEXT,
        created_at TEXT,
        FOREIGN KEY(user_id) REFERENCES users(id)
    )');

    $stmt = $db->prepare('SELECT email FROM users WHERE id = :user_id');
    $stmt->bindValue(':user_id', $userId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user) {
        $userEmail = $user['email'];


        $stmt = $db->prepare('INSERT INTO support_messages (user_id, message, created_at) VALUES (:user_id, :message, :created_at)');
        $stmt->bindValue(':user_id', $userId, SQLITE3_INTEGER);
        $stmt->bindValue(':message', $message, SQLITE3_TEXT);
        $stmt->bindValue(':created_at', $createdAt, SQLITE3_TEXT);


        if ($stmt->execute()) {
            echo "<script>
                alert('Message transmis au support ! Email utilisateur pour recevoir votre réponse : $userEmail');
                window.location.href = 'para.php'; // Redirect to a specific page
            </script>";
        } else {
            throw new Exception('Failed to insert message.');
        }
    } else {
        throw new Exception('Utilisateur non trouvé.');
    }
} catch (Exception $e) {
    echo "<script>
        alert('Erreur: " . $e->getMessage() . "');
        window.location.href = 'para.php'; // Redirect to a specific page
    </script>";
}
?>
