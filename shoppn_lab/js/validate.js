document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registerForm');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phoneRegex = /^[0-9+\-\s]{7,15}$/;
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; // Minimum 8 characters, at least one letter and one number

        const email = document.getElementById('customer_email').value.trim();
        const contact = document.getElementById('customer_contact').value.trim();
        const password = document.getElementById('customer_pass').value.trim();

        let valid = true;

        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            valid = false;
        }

        if (!passwordRegex.test(password)) {
            alert('Please enter a valid password (minimum 8 characters, at least one letter and one number).');
            valid = false;
        }

        if (!phoneRegex.test(contact)) {
            alert('Please enter a valid contact number (7–15 digits, may include + - and spaces).');
            valid = false;
        }

        if (!valid) {
            e.preventDefault(); //stops form from submitting if validation fails
        }
    });
});