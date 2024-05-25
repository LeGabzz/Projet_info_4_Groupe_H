<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recette Dynamique</title>
    <link rel="stylesheet" href="plat2.css">
    <link rel="stylesheet" href="../bande.css">
    <link rel="stylesheet" href="../menu.css">
    <link href="https://fonts.googleapis.com/css2?family=Pinyon+Script&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../header_favs.html'; ?>
    <div class="container">
        <h1 id="title-content">Recette Dynamique</h1>
        <img id="recipe-image" src="" alt="Recipe Image">
        <p id="type-content"></p>
        <p id="price-content"></p>
        <p id="nutrition-content"></p>
        <p id="description-content"></p>
        <p id="preparation-time-content"></p>
        <p id="cooking-time-content"></p>
        <p id="serving-content"></p>

        <h2>Ingrédients</h2>
        <ul id="ingredients-content"></ul>
        <h2>Ustensiles</h2>
        <ul id="utensils-content"></ul>

        <h2>Étapes de préparation</h2>
        <ul id="instructions-content"></ul>

        <button onclick="window.location.href='/';">Menu</button> <!-- Bouton pour retourner à la page précédente -->
        <button class="nav-button" id="delete-recipe">Retirer des favoris</button>
        <button class="nav-button" id="next-recipe">Prochaine recette</button>
    </div>

    <script>
        let currentIndex = 0; // Store the current recipe index
        let totalRecipes = 0; // Dynamically update the total number of recipes
        let recipes = []; // Store all recipes

        // Function to populate the sections with data
        function populateSections(recipe) {
            try {
                document.getElementById('title-content').innerText = recipe.title || 'N/A';
                document.getElementById('recipe-image').src = recipe.image || '';
                document.getElementById('type-content').innerText = 'Type de cuisine : ' + (recipe.type || 'N/A');
                document.getElementById('price-content').innerText = 'Tranche de prix : ' + (recipe.price || 'N/A');
                document.getElementById('nutrition-content').innerText = 'Équilibre nutritionnel : ' + (recipe.nutrition || 'N/A');
                document.getElementById('description-content').innerText = 'Description du plat : ' + (recipe.description || 'N/A');
                document.getElementById('preparation-time-content').innerText = 'Temps de préparation : ' + (recipe.preparationTime || 'N/A');
                document.getElementById('cooking-time-content').innerText = 'Temps de cuisson : ' + (recipe.cookingTime || 'N/A');
                document.getElementById('serving-content').innerText = 'Pour : ' + (recipe.serving || 'N/A');

                // Populate ingredients
                document.getElementById('ingredients-content').innerHTML = recipe.ingredients || '';

                // Populate utensils
                document.getElementById('utensils-content').innerHTML = recipe.utensils || '';

                // Populate instructions
                document.getElementById('instructions-content').innerHTML = recipe.instructions || '';

            } catch (error) {
                console.error('Error populating sections:', error);
            }
        }

        // Fetch data from the server
        function fetchData() {
            try {
                fetch('getRecipeData2.php')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Data fetched:', data); // Debugging line
                        if (data && Array.isArray(data.recipes)) {
                            recipes = data.recipes; // Store all recipes
                            totalRecipes = recipes.length; // Store the total number of recipes
                            if (totalRecipes > 0) {
                                populateSections(recipes[currentIndex]); // Populate sections with the first recipe
                            } else {
                                console.error('No recipes found');
                            }
                        } else {
                            throw new Error('Invalid data format');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            } catch (error) {
                console.error('Error initiating fetch request:', error);
            }
        }

        // Delete recipe from favorites
        function deleteFromFavorites() {
            if (currentIndex === null) {
                console.error('No recipe index found');
                return;
            }
            fetch('deleteRecipe.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ index: currentIndex })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error(data.error);
                } else {
                    alert('Recipe deleted from favorites!');
                    recipes = data.recipes; // Update the recipes array
                    totalRecipes = recipes.length; // Update the total number of recipes
                    currentIndex = 0; // Reset to the first recipe
                    if (totalRecipes > 0) {
                        populateSections(recipes[currentIndex]); // Populate sections with the updated first recipe
                    } else {
                        // Clear the sections if no recipes left
                        document.getElementById('title-content').innerText = '';
                        document.getElementById('recipe-image').src = '';
                        document.getElementById('type-content').innerText = '';
                        document.getElementById('price-content').innerText = '';
                        document.getElementById('nutrition-content').innerText = '';
                        document.getElementById('description-content').innerText = '';
                        document.getElementById('preparation-time-content').innerText = '';
                        document.getElementById('cooking-time-content').innerText = '';
                        document.getElementById('serving-content').innerText = '';
                        document.getElementById('ingredients-content').innerText = '';
                        document.getElementById('utensils-content').innerText = '';
                        document.getElementById('instructions-content').innerText = '';
                    }
                }
            })
            .catch(error => {
                console.error('Error deleting from favorites:', error);
            });
        }

        // Event listener for the Delete from Favorites button
        document.getElementById('delete-recipe').addEventListener('click', () => {
            deleteFromFavorites();
        });

        // Event listener for the Next Recipe button
        document.getElementById('next-recipe').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % totalRecipes;
            populateSections(recipes[currentIndex]);
        });

        // Call the function to fetch data when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            fetchData();
        });
    </script>
</body>
</html>
