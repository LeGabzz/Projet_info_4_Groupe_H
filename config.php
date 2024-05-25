<?php
// Database connection settings
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'db1';

// For SQLite
$db = new SQLite3('my_database.db');

// Function to create the database schema if it doesn't exist
function initializeDatabase($db) {
    $db->exec('CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        age INTEGER,
        fullname TEXT,
        country TEXT
    )');

    // Optional: Insert initial data if the table is empty
    $result = $db->query('SELECT COUNT(*) as count FROM users');
    $row = $result->fetchArray();
    if ($row['count'] == 0) {
        $db->exec("INSERT INTO users (email, password, age, fullname, country) VALUES ('testuser1@example.com', 'password1', 25, 'Test User One', 'Country1')");
        $db->exec("INSERT INTO users (email, password, age, fullname, country) VALUES ('testuser2@example.com', 'password2', 30, 'Test User Two', 'Country2')");
    }
}

// Initialize the database
initializeDatabase($db);
?>
