window.onload = function() {
    var inputs = document.querySelectorAll('input[type="number"], input[type="text"]');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.borderColor = '#4CAF50';
        });
        input.addEventListener('blur', () => {
            input.style.borderColor = '#ccc';
        });
    });

    var form = document.getElementById('register-step2-form');
    form.addEventListener('submit', (e) => {
        form.classList.add('submitting');
        setTimeout(() => {
            form.classList.remove('submitting');
        }, 1000);
    });
}

