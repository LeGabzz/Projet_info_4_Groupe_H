<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>
	alert('Vous devez être connecté pour performer cette action');
	</script>";
header("Location: logt.php");
    exit;
}

header('Content-Type: application/json');

$userId = $_SESSION['user_id'];
$favoritesFile = 'user_data/user_' . $userId . '_recipes.json';

if (file_exists($favoritesFile)) {
    // Clear the recipes
    $favoritesData = ['recipes' => []];
    file_put_contents($favoritesFile, json_encode($favoritesData));
echo json_encode(['success' => 'Historique des recherches effacé !']);    
} else {
       echo json_encode(['error' => 'Erreur lors de l\'effacement de l\'historique des recherches.']);
}
?>