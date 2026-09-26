function registerCustomer() {
	
	var name = document.getElementById("customer_name").value.trim();
	var email = document.getElementById("customer_email").value.trim();
	var pass = document.getElementById("customer_pass").value.trim();
	var country = document.getElementById("customer_country").value.trim();
	var city = document.getElementById("customer_city").value.trim();
	var contact = document.getElementById("customer_contact").value.trim();

	
	var messageEl = document.getElementById("formMessage");

	
	var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

	
	if (!name || !email || !pass || !country || !city || !contact) {
		messageEl.textContent = "Please fill in all required fields.";
		return;
	}

	
	if (!emailPattern.test(email)) {
		messageEl.textContent = "Please enter a valid email address.";
		return;
	}

	
	var formData = new FormData(document.getElementById("registerForm"));

	
	fetch("../actions/customer_register_action.php", {
		method: "POST",
		body: formData
	})
		.then(function (response) {
			
			return response.json();
		})
		.then(function (data) {
			
			messageEl.textContent = data.message;

			
			if (data.success) {
				document.getElementById("registerForm").reset();
			}
		})
		.catch(function () {
			
			messageEl.textContent = "Something went wrong. Please try again.";
		});
}