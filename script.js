function toggleMenu() {
    var menu = document.querySelector('.menu');
    menu.classList.toggle('active');

    // Clear existing menu if toggling off
    menu.innerHTML = menu.classList.contains('active') ? '<li><a href="#">Option 1</a></li><li><a href="#">Option 2</a></li>' : '';
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.menu-button').addEventListener('click', toggleMenu);
});
