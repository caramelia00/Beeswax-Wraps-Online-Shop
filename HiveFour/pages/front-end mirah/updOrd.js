const selectElements = document.querySelectorAll('.mySelect');
const imageElements = document.querySelectorAll('.myImage');

selectElements.forEach((selectElement, index) => {
    const imageElement = imageElements[index];

    selectElement.addEventListener('change', function() {
        const selectedValue = this.value;

        if (selectedValue === 'default') {
            // Hide the image when the default option is selected
            imageElement.style.display = 'none';
        } else {
            // Show the image when an option other than the default is selected
            imageElement.style.display = 'block';

            const imageSrc = selectedValue === 'true' ? 'done.png' : 'default.png';
            imageElement.src = imageSrc;

            if (selectedValue === 'true') {
                imageElement.style.width = '40px';
                imageElement.style.height = '40px';
            } else {
                imageElement.style.width = '40px';
                imageElement.style.height = '40px';
            }
        }
    });
});
//accept changes made
// Function to fetch updated order details
function updateOrderDetails() {
    // Make an AJAX request to fetch updated order information
    fetch('update order details.php')
        .then(response => response.json())
        .then(data => {
            // Update the date value
            document.getElementById('dateValue').innerText = data.orderDate;
            
            // Update the status image source
            document.getElementById('statusImage').src = data.statusImageUrl;
        })
        .catch(error => console.error('Error:', error));
}

// Call the function to update order details initially
updateOrderDetails();

// Set up a timer to periodically update the order details (e.g., every 30 seconds)
// setInterval(updateOrderDetails, 30000); // 30 seconds interval