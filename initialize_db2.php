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


$db->exec('DELETE FROM support_messages');
$db->exec('DELETE FROM users');

$db->exec("INSERT INTO users (email, password, age, fullname, country, reqs) VALUES
    ('testuser1@example.com', 'password1', 25, 'TestINITDBPHP User One', 'Country1', 0),
    ('testuser2@example.com', 'password2', 30, 'Test User Two', 'Country2', 10)
");

$db->exec("INSERT INTO support_messages (user_id, message, created_at) VALUES
    (1, 'This is a test message from user 1', '2023-05-01 12:00:00'),
    (2, 'This is another test message from user 2', '2023-05-02 13:00:00')
");

echo "Database initialized and sample data inserted.";
?>
