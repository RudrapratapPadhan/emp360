function validateLoginForm(e) {
    e.preventDefault();
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    let isValid = true;

    if (!emailPattern.test(email)) {
        document.getElementById('email-error').innerText = "Please enter a valid email address.";
        isValid = false;
    } else {
        document.getElementById('email-error').innerText = "";
    }

    if (password.length < 8) {
        document.getElementById('password-error').innerText = "Password must be at least 8 characters long.";
        isValid = false;
    } else {
        document.getElementById('password-error').innerText = "";
    }

    if (isValid) {
        document.getElementById('login-form').submit();
    }

    return false;
}
