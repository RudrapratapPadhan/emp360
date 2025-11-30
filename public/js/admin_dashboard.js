function showEmployeeDialog() {
    let viewEmp = document.getElementById('view-employee-btn');
    let dialog = document.getElementById('employee-dialog');
    
    // Toggle dialog visibility
    if (dialog.style.display === "none" || dialog.style.display === "") {
        // Show dialog
        dialog.style.display = "block";
        viewEmp.innerText = "Close";
    } else {
        // Hide dialog
        dialog.style.display = "none";
        viewEmp.innerText = "View Employees";
    }
}

// Close dialog when clicking outside
window.onclick = function(event) {
    let dialog = document.getElementById('employee-dialog');
    let viewEmp = document.getElementById('view-employee-btn');
    
    if (event.target == dialog) {
        dialog.style.display = "none";
        if (viewEmp) {
            viewEmp.innerText = "View Employees";
        }
    }
}