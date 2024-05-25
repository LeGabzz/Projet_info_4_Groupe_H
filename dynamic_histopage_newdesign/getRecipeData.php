<?php
session_start();
ob_start(); // Start output buffering
/*if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: logt.html');
    exit;
} */
header('Content-Type: application/json');
//PQ LOAD PAS NEWDESIGN / ADAPTER A TT ONGLET / TEST IMG
//$userId = $_SESSION['user_id'];
$recipesFile = '../user_data/user_123_recipes.json';

if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $data = json_decode($jsonData, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['error' => 'JSON decode error: ' . json_last_error_msg()]);
        ob_end_flush(); // Flush the output buffer
        exit;
    }

    $recipes = $data['recipes'];
    $totalRecipes = count($recipes);

    if (isset($_GET['index']) && is_numeric($_GET['index'])) {
        $index = (int)$_GET['index'];
        if ($index >= 0 && $index < $totalRecipes) {
            $response = $recipes[$index];
            $response['index'] = $index;
            $response['totalRecipes'] = $totalRecipes;
            $response['recipes'] = $recipes; // Include the entire array of recipes
            echo json_encode($response);
        } else {
            echo json_encode(['error' => 'Invalid index']);
        }
    } else {
        $response = $recipes[0];
        $response['index'] = 0;
        $response['totalRecipes'] = $totalRecipes;
        $response['recipes'] = $recipes; // Include the entire array of recipes
        echo json_encode($response);
    }
} else {
    echo json_encode(['error' => 'File not found']);
}

ob_end_flush(); // Flush the output buffer
?>
