document.addEventListener('DOMContentLoaded', function() {
    // Registration form validation
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
            }
        });
    }

    // Food posting form validation
    const foodForm = document.getElementById('food-form');
    if (foodForm) {
        foodForm.addEventListener('submit', function(e) {
            const expiryDate = new Date(document.getElementById('expiry_date').value);
            const today = new Date();
            
            if (expiryDate < today) {
                e.preventDefault();
                alert('Expiry date cannot be in the past!');
            }
        });
    }
});