function validateRegistrationForm(e) {
    e.preventDefault();
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('confirm_password').value;
    let mobile = document.getElementById('mobile').value;
    let age = document.getElementById('age').value;
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;  
    let passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;   
    let mobilePattern = /^\+?[0-9]{10,15}$/;
    
    
    if (!emailPattern.test(email)) {
        document.getElementById('email-error').innerText = "Please enter a valid email address.";
        return false;
    } else {
        document.getElementById('email-error').innerText = "";
    }

    if(password.test(passwordPattern) === false){
        document.getElementById('password-error').innerText = "Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.";
        return false;
    }


    if(password !== confirmPassword){
        document.getElementById('confirm-password-error').innerText = "Passwords do not match.";
        return false;
    } else {
        document.getElementById('confirm-password-error').innerText = "";
    }

    if(!mobilePattern.test(mobile)){
        document.getElementById('mobile-error').innerText = "Please enter a valid mobile number.";
        return false;
    } else {
        document.getElementById('mobile-error').innerText = "";
    }   

    if(age < 18 || age > 100){
        document.getElementById('age-error').innerText = "Age must be between 18 and 100.";
        return false;
    } else {
        document.getElementById('age-error').innerText = "";
    }

    return true;

}