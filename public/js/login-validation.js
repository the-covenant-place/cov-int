document.getElementById('loginForm').addEventListener('submit', function(event) {
    let isValid = true;

    // Clear previous error messages
    document.getElementById('usernameError').textContent = '';
    document.getElementById('passwordError').textContent = '';

    // Username Validation
    const username = document.getElementById('username').value;
    const usernamePattern = /^[a-zA-Z0-9_]+$/;
    if (!usernamePattern.test(username)) {
        isValid = false;
        document.getElementById('usernameError').textContent = 'Username can only contain letters, numbers, and underscores.';
    }

    // Password validation
    const password = document.getElementById('password').value;
    if (password.length < 8) {
        isValid = false;
        document.getElementById('passwordError').textContent = 'Password must be at least 8 characters long.';
    }

    // If validation fails prevent form submission
    if (!isValid) {
        event.preventDefault();
    }
});