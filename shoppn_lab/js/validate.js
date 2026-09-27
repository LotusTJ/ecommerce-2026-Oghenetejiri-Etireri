document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registerForm');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phoneRegex = /^[0-9+\-\s]{7,15}$/;

        const email = document.getElementById('customer_email').value.trim();
        const contact = document.getElementById('customer_contact').value.trim();

        let valid = true;

        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
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