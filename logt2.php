<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "<script>
        alert('Vous êtes déjà connecté !');
        window.location.href = '/';
    </script>";
}

$db = new SQLite3('my_database2.db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rem = isset($_POST['remember']); 
    $ip = $_SERVER['REMOTE_ADDR'];

    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    if (!$result) {
        echo "<script>
            alert('Failed to execute query.');
            window.location.href = 'login.html';
        </script>";
        exit();
    }

    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['loggedin'] = true;
        if ($user['email'] == 'admin@lcdc.com' || $user['email'] == 'test2@gmail.com') {
            $_SESSION['admin'] = true;
        } else {
            $_SESSION['admin'] = false;
        }
        setcookie('ip', $ip, time() + (86400 * 30), "/");
        if ($rem) {
            setcookie('user_id', $user['id'], time() + (86400 * 30), "/");
            setcookie('email', $user['email'], time() + (86400 * 30), "/");
        }
        echo "<script>
            alert('Connecté !');
            window.location.href = '/';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Problème lors de la connexion.');
            window.location.href = 'logt.php';
        </script>";
        exit();
    }
} else {
    echo "<script>
        alert('Invalid request method.');
        window.location.href = 'logt.php';
    </script>";
    exit();
}
?>
