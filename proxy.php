<?php
session_start();

// Check if the form data is posted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Store the POST data in the session to pass to the actual script
    $_SESSION['post_data'] = $_POST;

    // Display the loading message or animation
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Loading</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
  
        <div class="loading-container">
            ' . file_get_contents('loading.html') . '
        </div>
     
    </body>
    </html>
    ';


sleep(5);

    // Redirect to the actual script
    header('Location: gptform8.php');
    exit;
}
?>
