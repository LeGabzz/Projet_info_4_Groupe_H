<?php
ob_start();
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true') {
    echo "<script>
        alert('Vous êtes déjà connecté !');
        window.location.href = '/';
    </script>";
}

$db = new SQLITE3('my_database2.db');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $country = $_POST['country'];

    // Check if email already exists
    $stmt = $db->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    $count = $result->fetchArray(SQLITE3_NUM)[0];

    if ($count > 0) {
        echo "<script>
            alert('Email already registered.');
            window.location.href = 'register.html';
        </script>";
        exit;
    }

    if (empty($email) || empty($password) || empty($fullname) || empty($age) || empty($country)) {
        echo "<script>
            alert('All fields are required.');
            window.location.href = 'register.html';
        </script>";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare('INSERT INTO users (email, password, fullname, age, country) VALUES (:email, :password, :fullname, :age, :country)');
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $hashed_password, SQLITE3_TEXT);
    $stmt->bindValue(':fullname', $fullname, SQLITE3_TEXT);
    $stmt->bindValue(':age', $age, SQLITE3_INTEGER);
    $stmt->bindValue(':country', $country, SQLITE3_TEXT);

    if ($stmt->execute()) {
        $_SESSION['email'] = $email;
        $_SESSION['loggedin'] = true;
        echo "<script>
            alert('Inscription prise en compte.');
            window.location.href = 'logt.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Problème lors de l\'enregistrement.');
            window.location.href = 'register.html';
        </script>";
        exit();
    }
} else {
    echo "<script>
        alert('Invalid request method.');
        window.location.href = 'register.html';
    </script>";
    exit();
}

$db->close();
?>
