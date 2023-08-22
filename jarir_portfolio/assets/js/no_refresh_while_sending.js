// script.js

// Get the form and response elements
const messageForm = document.getElementById("messageForm");
const responseElement = document.getElementById("response");
const sendMessageButton = document.getElementById("sendMessageButton");

// Add an event listener for button click
sendMessageButton.addEventListener("click", function () {
    // Create a new FormData object from the form
    const formData = new FormData(messageForm);

    // Send a POST request to Send_Message.php using AJAX
    fetch("Send_Message.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.text())
    .then(data => {
        // Display the response in the response element
        responseElement.innerHTML = `<br><span style="color: green;">${data}</span><br>`;
    })
    .catch(error => {
        console.error("Error:", error);
    });
});
