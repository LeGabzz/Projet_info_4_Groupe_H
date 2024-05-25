document.getElementById('clear-history').addEventListener('click', function() {
    var searchHistory = document.getElementById('search-history');
    searchHistory.innerHTML = ''; // Efface tout le contenu de la liste
    var message = document.getElementById('message');
    message.textContent = 'Historique effacé'; // Définir le message
    message.style.display = 'block'; // Afficher le message

    // Après 3 secondes, cacher le message
    setTimeout(function() {
        message.style.display = 'none';
    }, 3000);
});
