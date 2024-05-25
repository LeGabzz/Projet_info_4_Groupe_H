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
    <title>Inscription</title>
</head>
<body>
    <?php include 'header_register.html'; ?>
    <main class="login-page">
        <div class="login-container">
            <img src="IMG_0190.jpg" alt="La Cuisine Du Chef Logo" class="logo">
            <h2>Bienvenue !</h2>
            <form method="POST" action="regt3.php" id="register-form">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="mot de passe" required>
                <input type="text" name="fullname" id="fullname" placeholder="Nom complet" required>
                <input type="number" name="age" id="age" placeholder="Age" required>
                <input type="text" name="country" id="country" placeholder="Pays" required>
                <button type="submit">Inscription</button>
            </form>
        </div>
    </main>
    <script src="login2.js"></script>
</body>
</html>
