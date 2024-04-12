  

document.addEventListener('DOMContentLoaded', function() {
   
	  var form = document.getElementById("forminator-module-21016");
		
        if (form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the form from submitting normally
 				
                // Get form fields
                var formData = new FormData(form);
                var formFields = {
                    "name": formData.get('name-1'),
                    "email": formData.get('email-1'),
                  
                };
				
 				
                // Construct the payload
                var payload = {
                    "apiKey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY0M2Y3YzA2NjNiOTM4MGJkM2MyZGY1NCIsIm5hbWUiOiJVbmljYWwgU3lzdGVtcyBQcml2YXRlIExpbWl0ZWQiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjQzZjdjMDY2M2I5MzgwYmQzYzJkZjRmIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE2ODE4ODIxMTh9.0kGWAogsqYRoypVefQAvnUAOxRVRD7tYFTnfWwZNOJ0",
                    "campaignName": "ua_resume_assist_camp",
                    "destination": "+91 7799999996",
                    "templateParams": [formFields['name'],formFields['email']]
                };
 
                // Convert payload to JSON
                var jsonPayload = JSON.stringify(payload);
 
                // Create a new XHR object
                var xhr = new XMLHttpRequest();
                // Define the request method, endpoint, and set headers
                xhr.open('POST', 'https://backend.api-wa.co/campaign/whatsapp bizz solutions/api', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
 
                // Define the onload handler to handle successful responses
                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        // Request was successful
                       // alert('Form submitted successfully!');
                    } else {
                        // Request failed
                        //alert('There was a problem submitting the form. Please try again later.');
                    }
                };
 
                // Define the onerror handler to handle errors
                xhr.onerror = function() {
                    //alert('There was a problem submitting the form. Please try again later.');
                };
 
                // Send the request with the JSON payload
                xhr.send(jsonPayload);
            });
        }
    });