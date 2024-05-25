// Check if remember me checkbox is checked on page load
window.onload = function() {
    if (document.getElementById('remember').checked) {
        // Retrieve username from cookie
        var username = getCookie('username');
        if (username !== "") {
            // Ask the user if they want to return to the session
            if (confirm("Do you want to return to your previous session?")) {
                // Redirect to dashboard or another page
                window.location.href = "dashboard.php";
            }
        }
    }

    // Add focus and blur events to inputs
    var inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.borderColor = '#4CAF50';
        });
        input.addEventListener('blur', () => {
            input.style.borderColor = '#ccc';
        });
    });

    // Add a submit event to the form
    var form = document.getElementById('login-form');
    form.addEventListener('submit', (e) => {
        // Add a simple animation on submit
        form.classList.add('submitting');
        setTimeout(() => {
            form.classList.remove('submitting');
        }, 1000);
    });
}

// Function to retrieve cookie value
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return "";
}
