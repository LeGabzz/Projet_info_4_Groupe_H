<?php
session_start();
header('Content-Type: application/json');

$userId = $_SESSION['user_id'];
$jsonFile = '../user_' . $userId . '_favs.json';
//$jsonFile = '../user_data/user_123_favs.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['index']) && is_numeric($input['index'])) {
        $index = (int)$input['index'];

        if (file_exists($jsonFile)) {
            $jsonData = file_get_contents($jsonFile);
            $data = json_decode($jsonData, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['error' => 'JSON decode error: ' . json_last_error_msg()]);
                exit;
            }

            if ($index >= 0 && $index < count($data['recipes'])) {
                array_splice($data['recipes'], $index, 1); // Remove the recipe at the specified index
                file_put_contents($jsonFile, json_encode($data)); // Save the updated data back to the file

                echo json_encode(['success' => 'Recipe deleted successfully', 'recipes' => $data['recipes'], 'totalRecipes' => count($data['recipes'])]);
            } else {
                echo json_encode(['error' => 'Invalid index']);
            }
        } else {
            echo json_encode(['error' => 'File not found']);
        }
    } else {
        echo json_encode(['error' => 'Index parameter is required']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
