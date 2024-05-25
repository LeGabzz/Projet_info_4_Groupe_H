<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login3.css">
    <link rel="stylesheet" href="bande.css">
    <link rel="stylesheet" href="menu.css">
    <link href="https://fonts.googleapis.com/css2?family=Pinyon+Script&display=swap" rel="stylesheet">
    <title>Connexion</title>
</head>
<body>
    <?php include 'header_login.html'; ?>
    <main class="login-page">
        <div class="login-container">
            <img src="IMG_0190.jpg" alt="La Cuisine Du Chef Logo" class="logo">
            <h2>Login</h2>
            <form method="POST" action="logt2.php" id="login-form">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                <div id="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Rester connecter</label>
                </div>
                <button type="submit">Connexion</button>
            </form>
            <button id="register-button" onclick="window.location.href='regt2.php'">Inscription</button>
        </div>
    </main>
    <script src="login2.js"></script>
</body>
</html>
