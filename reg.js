window.onload = function() {
    var inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.borderColor = '#4CAF50';
        });
        input.addEventListener('blur', () => {
            input.style.borderColor = '#ccc';
        });
    });

    var form = document.getElementById('register-step1-form');
    form.addEventListener('submit', (e) => {
        console.log('Form is being submitted');
        form.classList.add('submitting');
        setTimeout(() => {
            form.classList.remove('submitting');
        }, 1000);
    });
}
