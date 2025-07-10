// validation.js - Simple Form Validation for ShareBite

// Wait until the page is fully loaded before running our code
document.addEventListener('DOMContentLoaded', function() {

    // 1. REGISTER FORM VALIDATION
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            // Prevent the form from submitting automatically
            event.preventDefault();
            
            // Get all the form values
            const fullName = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            // Reset previous error messages
            clearErrors();
            
            // Validate each field one by one
            let isValid = true;
            
            // Name validation - must be at least 2 characters, only letters and spaces
            if (fullName.length < 2) {
                showError('nameError', 'Name must be at least 2 characters');
                isValid = false;
            } else if (!/^[a-zA-Z\s]+$/.test(fullName)) {
                showError('nameError', 'Name can only contain letters and spaces');
                isValid = false;
            }
            
            // Email validation - must contain @ and .
            if (!email.includes('@') || !email.includes('.')) {
                showError('emailError', 'Please enter a valid email address');
                isValid = false;
            }
            
            // Password validation - must be at least 8 characters
            if (password.length < 8) {
                showError('passwordError', 'Password must be at least 8 characters');
                isValid = false;
            }
            
            // Password match validation
            if (password !== confirmPassword) {
                showError('passwordError', 'Passwords do not match');
                isValid = false;
            }
            
            // If everything is valid, submit the form
            if (isValid) {
                alert('Registration successful!');
                // registerForm.submit(); // Uncomment this to actually submit the form
            }
        });
    }

    // 2. LOGIN FORM VALIDATION (simpler version)
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const email = document.getElementById('loginEmail').value.trim();
            
            clearErrors();
            
            if (!email.includes('@') || !email.includes('.')) {
                showError('loginEmailError', 'Please enter a valid email address');
            } else {
                alert('Login successful!');
                // loginForm.submit(); // Uncomment to actually submit
            }
        });
    }

    // 3. FOOD SHARE FORM VALIDATION
    const shareForm = document.getElementById('shareForm');
    if (shareForm) {
        shareForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const expiryDate = new Date(document.getElementById('expiry').value);
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Set time to midnight for accurate date comparison
            
            if (expiryDate < today) {
                alert('Expiry date cannot be in the past');
            } else {
                alert('Food shared successfully!');
                // shareForm.submit(); // Uncomment to actually submit
            }
        });
    }

    // HELPER FUNCTIONS
    
    // Show error message under a field
    function showError(elementId, message) {
        const errorElement = document.getElementById(elementId);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }
    }
    
    // Clear all error messages
    function clearErrors() {
        const errors = document.querySelectorAll('.error');
        errors.forEach(error => {
            error.textContent = '';
            error.style.display = 'none';
        });
    }
});