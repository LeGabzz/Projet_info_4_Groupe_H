<?php
session_start();
/*if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../logt.html');
    exit;
}*/
header('Content-Type: application/json');

$userId = $_SESSION['user_id'];
$recipesFile = '../user_3_recipes.json';
$favoritesFile = '../user_3_favs.json';

if (isset($_GET['index']) && is_numeric($_GET['index'])) {
    $index = (int)$_GET['index'];


    if (file_exists($recipesFile)) {
        // Read the recipes JSON file
        $jsonData = file_get_contents($recipesFile);
        $recipesData = json_decode($jsonData, true);

        if ($index >= 0 && $index < count($recipesData['recipes'])) {
            $recipe = $recipesData['recipes'][$index];

        
            if (file_exists($favoritesFile)) {
                $favoritesData = json_decode(file_get_contents($favoritesFile), true);
            } else {
                $favoritesData = ['recipes' => []];
            }

          
            $favoritesData['recipes'][] = $recipe;

         
            file_put_contents($favoritesFile, json_encode($favoritesData));

            echo json_encode(['success' => 'Recette ajoutée aux favorites !']);
        } else {
            echo json_encode(['error' => 'Invalid index']);
        }
    } else {
        echo json_encode(['error' => 'Recipes file not found']);
    }
} else {
    echo json_encode(['error' => 'Index parameter is required']);
}
?>
