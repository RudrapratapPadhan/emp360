function validateEmployeeForm(e) {
    e.preventDefault();
    let email = document.getElementById('email').value;
    let mobile = document.getElementById('mobile').value;
    let age = document.getElementById('age').value;
    let password = document.getElementById('password');
    let confirmPassword = document.getElementById('confirm_password');

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    let mobilePattern = /^\+?[0-9]{10,15}$/;

    let isValid = true;

    if (!emailPattern.test(email)) {
        document.getElementById('email-error').innerText = "Please enter a valid email address.";
        isValid = false;
    } else {
        document.getElementById('email-error').innerText = "";
    }

    if (!mobilePattern.test(mobile)) {
        document.getElementById('mobile-error').innerText = "Please enter a valid mobile number (10-15 digits).";
        isValid = false;
    } else {
        document.getElementById('mobile-error').innerText = "";
    }

    if (age < 18 || age > 100) {
        document.getElementById('age-error').innerText = "Age must be between 18 and 100.";
        isValid = false;
    } else {
        document.getElementById('age-error').innerText = "";
    }

    if (password && password.value) {
        if (!passwordPattern.test(password.value)) {
            document.getElementById('password-error').innerText = "Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.";
            isValid = false;
        } else {
            document.getElementById('password-error').innerText = "";
        }

        if (confirmPassword && password.value !== confirmPassword.value) {
            document.getElementById('confirm-password-error').innerText = "Passwords do not match.";
            isValid = false;
        } else {
            document.getElementById('confirm-password-error').innerText = "";
        }
    }

    if (isValid) {
        e.target.submit();
    }

    return false;
}
