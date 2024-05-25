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
// Use a dummy user ID for demonstration purposes
//$userId = 123;
$jsonFile = '../user_data/user_' . $userId . '_recipes.json'; // Correct the variable name

// Check if the file exists and is readable
if (file_exists($jsonFile) && is_readable($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $data = json_decode($jsonData, true);

    // Check for JSON decoding errors
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['error' => 'JSON decode error: ' . json_last_error_msg()]);
        ob_end_flush(); // Flush the output buffer
        exit;
    }

    $recipes = $data['recipes'];
    $totalRecipes = count($recipes);

    // Get the index from the query parameter and ensure it's a valid number
    $index = isset($_GET['index']) && is_numeric($_GET['index']) ? (int)$_GET['index'] : 0;

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
    echo json_encode(['error' => 'File not found or not readable']);
}

ob_end_flush(); // Flush the output buffer
?>
