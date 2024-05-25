<?php
session_start();
/*if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../logt.html');
    exit;
}*/
header('Content-Type: application/json');

// Path to your JSON files
//$userId = $_SESSION['user_id'];
$userId = $_SESSION['user_id'];
$favoritesFile = '../user_data/user_' . $userId . '_favs.json';
$recipesFile = '../user_data/user_' . $userId . '_recipes.json';

// Check if the index parameter is set in the GET request
if (isset($_GET['index']) && is_numeric($_GET['index'])) {
    $index = (int)$_GET['index'];

    // Check if the recipes file exists
    if (file_exists($recipesFile)) {
        // Read the recipes JSON file
        $jsonData = file_get_contents($recipesFile);
        $recipesData = json_decode($jsonData, true);

        // Check if the index is valid
        if ($index >= 0 && $index < count($recipesData['recipes'])) {
            $recipe = $recipesData['recipes'][$index];

            // Read the favorites JSON file, or create an empty array if it doesn't exist
            if (file_exists($favoritesFile)) {
                $favoritesData = json_decode(file_get_contents($favoritesFile), true);
            } else {
                $favoritesData = ['recipes' => []];
            }

            // Add the recipe to the favorites
            $favoritesData['recipes'][] = $recipe;

            // Save the updated favorites JSON file
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
