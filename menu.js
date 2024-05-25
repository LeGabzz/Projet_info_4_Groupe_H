function toggleMenu() {
    var menu = document.getElementById('menu');
    menu.classList.toggle('open');
}

// Fermer le menu lorsqu'on clique en dehors de celui-ci
window.onclick = function(event) {
    var menu = document.getElementById('menu');
    if (!event.target.matches('.menu-icon') && !event.target.closest('.menu')) {
        menu.classList.remove('open');
    }
}
