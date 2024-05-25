<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>La Cuisine du Chef</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="carousel.css">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="slogan.css">
    <link href="https://fonts.googleapis.com/css2?family=Pinyon+Script&display=swap" rel="stylesheet">
</head>
<body>
<!--<header>  
    <div class="logo"></div> 

    <h1 class="slogan">Mangez maison, mangez bon</h1>  
    <script src="menu.js"></script>
    <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
        <div id="menu" class="menu">
            <a href="logt.html" class="menu-item">Connexion</a>
            <a href="reg2t.html" class="menu-item">Inscription</a>
            <a href="favoris.html" class="menu-item">Favoris</a>
            <a href="para.html" class="menu-item">Paramètres</a>
            <a href="hist.html" class="menu-item">Historique</a>
    </div>

</header>
    -->
     <?php include 'header_index.html'; ?>
    <div id="slideshow" class="slideshow">
        <div id="slideshowInner" class="slideshow-inner">

            <img src="https://i0.wp.com/freethepickle.fr/wp-content/uploads/2021/03/chow-mein-vegetarien-3-of-3.jpg?resize=800%2C1000&ssl=1" alt="Image 1">
            <img src="https://www.mexique-voyages.com/wp-content/uploads/cuisine-recette-nourriture-1280x800.jpeg" alt="Image 2">
            <img src="https://static.cordonbleu.edu/Files/MediaFile/82638.jpg" alt="Image 3">
            <img src="https://aundetailpres.fr/wp-content/uploads/2024/01/DALL%C2%B7E-2024-01-12-20.30.11-A-large-serving-dish-or-deep-plate-at-the-center-of-the-image-generously-filled-with-fluffy-perfectly-cooked-couscous-fine-and-grainy-in-a-pale-ye-600x600.png" alt="Image 4">
            <img src="https://www.cookomix.com/wp-content/uploads/2021/08/pates-pesto-avocat-thermomix.jpg" alt="Image 5">
            <img src="https://images.immediate.co.uk/production/volatile/sites/30/2019/05/Ratatouille-ea27a5cdb519e400280f53734e71fc8bc.jpg" alt="Image 6">
            <img src="https://www.galbani.ch/wp-content/uploads/2020/08/Pinsa-romana-%C3%A0-la-tomate-%C3%A0-la-mozzarella-et-aux-champignons.jpg" alt="Image 7">
            <img src="https://images.radio-canada.ca/v1/alimentation/recette/4x3/burger-jamaicaine.jpg" alt="Image 8">
            <img src="https://img.cuisineaz.com/1280x720/2015/03/30/i95665-quiche-lorraine.jpg" alt="Image 9">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUv1yhuHwbXiY1o8288pPrwq5QXyaEHG5OfwhkjIH5vQ&s" alt="Image 10">
            <img src="https://cdn.chefclub.tools/uploads/recipes/cover-thumbnail/8753dacf-1bf0-49aa-8cd8-9574835cfba1_MhcuVes.jpg" alt="Image 11">
            <img src="https://cdn.chefclub.tools/uploads/recipes/cover-thumbnail/a4abd37f-89af-444c-84e3-70fff311a96f.jpg" alt="Image 12">
            <img src="https://www.mincidelice.com/files/boutique/produits/3505-wrap-hyperproteine-regime-minceur.jpg" alt="Image 13">
            <img src="https://www.healthyfoodcreation.fr/wp-content/uploads/2024/02/riz-saute-2024-1.jpg" alt="Image 14">
            <img src="https://static.blog4ever.com/2017/07/830202/artimage_830202_8216636_201905185956206.jpg?rev=1558243700" alt="Image 15">
            <img src="https://cdn.chefclub.tools/uploads/recipes/cover-thumbnail/df4ce919-9b64-4044-b094-73e3348fe9db.jpg" alt="Image 16">
            <img src="https://i0.wp.com/cuisinovores.com/wp-content/uploads/2023/04/photo_tartine_asperge_oeufmollet_midjourney.jpg?fit=500%2C500&ssl=1" alt="Image 17">
            <img src="https://static.750g.com/images/1200-630/d7ada6f2ba25b6e57dea40a54a5f8329/salade-de-riz.jpg" alt="Image 18">
            <img src="https://img.over-blog-kiwi.com/1/41/13/68/20200122/ob_6180d3_buddha-bowl-1.jpg" alt="Image 19">
            <img src="https://img.cuisineaz.com/660x660/2013/12/20/i34581-salade-nicoise-rapide.jpeg" alt="Image 20">
        </div>
    </div>

<script src="carousel.js"></script>

<main>
    <div class="welcome-box">
    <p>Bienvenue sur La Cuisine du Chef, votre source de recettes simples et savoureuses, adaptées à tous les niveaux et à tous les goûts. Que vous soyez novice ou expert, trouvez des plats faciles à réaliser, avec des instructions claires et des astuces pratiques. Transformez chaque repas en un moment de plaisir et de convivialité avec la Cuisine du Chef</p>
    </div>
  

</main>
<!-- Ajout de l'iframe pour charger chat.html -->
<div id="chat-section">
    <iframe src="chat2.html" style="width: 100%; height: 600px; border: none;"></iframe>
</div>
<!-- Ajout de l'iframe pour charger platpopu.html -->
<div id="platpopu-section">
    <iframe src="platpopu.html" style="width: 100%; height: 800px; border: none;"></iframe>
</div>

<!-- Section de pied de page -->
<footer class="footer">
    <div class="footer-content">
        <p>&copy; 2024 La Cuisine du Chef</p>
        <p><a href="contact.html">Contactez-nous</a></p>
        <p><a href="cookies.html">Politique de cookies</a></p>
    </div>
</footer>
<script>
        window.addEventListener('message', function(event) {
            if (event.data === 'showAlert') {
                alert('Recherche en cours');
            }
        });
</script>
</body>
</html>
