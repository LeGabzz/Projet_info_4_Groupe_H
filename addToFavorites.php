<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode(['error' => 'Vous devez être connecté pour performer cette action !']);
    exit;
}

header('Content-Type: application/json');

$data = file_get_contents('php://input');
$request = json_decode($data, true);

if (isset($request['id'])) {
    $dishId = $request['id'];

    // Determine the appropriate recipes file based on dish ID
    switch ($dishId) {
        case 1:
            $recipesFile = 'mar.json';
            break;
        case 2:
            $recipesFile = 'sus.json';
            break;
        case 3:
            $recipesFile = 'rat.json';
            break;
        case 4:
            $recipesFile = 'tac.json';
            break;
        case 5:
            $recipesFile = 'sal.json';
            break;
        default:
            echo json_encode(['error' => 'Erreur : impossible d\'ajouter aux favoris']);
            exit;
    }

    $userId = $_SESSION['user_id'];
    $favoritesFile = 'user_data/user_' . $userId . '_favs.json';

    // Check if the recipes file exists and read its content
    if (file_exists($recipesFile)) {
        $jsonData = file_get_contents($recipesFile);
        $recipe = json_decode($jsonData, true);

        // Check if the JSON decoding was successful
        if ($recipe === null) {
            echo json_encode(['error' => 'Erreur de décodage JSON']);
            exit;
        }

        // Read or initialize the user's favorites file
        if (file_exists($favoritesFile)) {
            $favoritesData = json_decode(file_get_contents($favoritesFile), true);
            if ($favoritesData === null) {
                $favoritesData = ['recipes' => []];
            }
        } else {
            $favoritesData = ['recipes' => []];
        }

        // Add the recipe to the user's favorites
        $favoritesData['recipes'][] = $recipe;
        file_put_contents($favoritesFile, json_encode($favoritesData));

        echo json_encode(['success' => 'Recette ajoutée aux favoris !']);
    } else {
        echo json_encode(['error' => 'Fichier de recettes non trouvé']);
    }
} else {
    echo json_encode(['error' => 'ID de plat requis']);
}
?>
