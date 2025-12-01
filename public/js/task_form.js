function validateTaskForm(e) {
    e.preventDefault();
    let title = document.getElementById('title').value.trim();
    let employeeId = document.getElementById('employee_id').value;
    let priority = document.getElementById('priority').value;
    let dueDate = document.getElementById('due_date');

    let isValid = true;

    if (title.length < 3) {
        document.getElementById('title-error').innerText = "Task title must be at least 3 characters long.";
        isValid = false;
    } else {
        document.getElementById('title-error').innerText = "";
    }

    if (!employeeId) {
        document.getElementById('employee-error').innerText = "Please select an employee.";
        isValid = false;
    } else {
        document.getElementById('employee-error').innerText = "";
    }

    if (!priority) {
        document.getElementById('priority-error').innerText = "Please select a priority.";
        isValid = false;
    } else {
        document.getElementById('priority-error').innerText = "";
    }

    if (dueDate && dueDate.value) {
        let selectedDate = new Date(dueDate.value);
        let today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate < today) {
            document.getElementById('date-error').innerText = "Due date cannot be in the past.";
            isValid = false;
        } else {
            document.getElementById('date-error').innerText = "";
        }
    }

    if (isValid) {
        e.target.submit();
    }

    return false;
}
