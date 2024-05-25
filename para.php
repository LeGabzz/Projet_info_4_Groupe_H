<?php 
@session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>
        alert('Vous devez être connecté pour performer cette action !');
        window.top.location.href = 'logt.php';
    </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres</title>
    <link rel="stylesheet" href="bande.css">
    <link rel="stylesheet" href="para.css">
    <link rel="stylesheet" href="menu.css">
    <link href="https://fonts.googleapis.com/css2?family=Pinyon+Script&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'header_param.html'; ?>
    
    <div class="settings-container">
        <h2>Paramètres</h2>
        <button class="settings-button" onclick="clearHistory()">Effacer l'historique des recherches</button><br>
        <button class="settings-button" onclick="clearFavorites()">Effacer mes favoris</button><br>
        <button onclick="fetchUserReqs()" class="settings-button">Nombre de Requêtes</button><br>
        <button class="settings-button" onclick="dirSM()">Demander un reset de votre limiter de Requêtes</button><br>
        <button class="settings-button" onclick="dirSupport()">Aide et Support</button>
    </div>

<script>

        function dirSM() {
            window.location.href = 'sm.php';
        }

        function dirSupport() {
            window.location.href = 'support.php';
        }

function clearHistory() {
        fetch('clearHisto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                alert(data.success);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    }

    function clearFavorites() {
        fetch('clearFavs.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                alert(data.success);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    }
        function fetchUserReqs() {
            fetch('getReqs.php') 
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        alert(JSON.stringify(data.reqs, null, 2));
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                });
        }
    </script>

</body>
</html>
