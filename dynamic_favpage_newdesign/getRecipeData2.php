<?php
session_start();
ob_start(); // Start output buffering
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>
        alert('Vous devez être connecté pour performer cette action !');
        window.location.href = '../logt.php';
    </script>";
    exit;
}

header('Content-Type: application/json');
$userId = $_SESSION['user_id'];
$jsonFile = '../user_data/user_' . $userId . '_favs.json';

if (file_exists($jsonFile) && is_readable($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $data = json_decode($jsonData, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['error' => 'JSON decode error: ' . json_last_error_msg()]);
        ob_end_flush(); // Flush the output buffer
        exit;
    }

    $recipes = isset($data['recipes']) ? $data['recipes'] : [];
    $totalRecipes = count($recipes);

    // Return the entire array of recipes along with the total number of recipes
    $response = [
        'recipes' => $recipes,
        'totalRecipes' => $totalRecipes
    ];

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'File not found or not readable']);
}

ob_end_flush(); // Flush the output buffer
?>
