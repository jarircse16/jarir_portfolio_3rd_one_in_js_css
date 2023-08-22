// JavaScript for handling AJAX and displaying the message
$(document).ready(function () {
    $("#messageForm").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting the traditional way

        // Send an AJAX request to delete_messages.php
        $.ajax({
            type: "POST",
            url: "delete_messages.php",
            data: { deleteMessages: "Delete All Messages" },
            dataType: "json", // Expect JSON response
            success: function (response) {
                // Display the message on the current page
                $("#response").html(response.message);
            },
            error: function () {
                // Handle error if the AJAX request fails
                $("#response").html("An error occurred while deleting messages.");
            }
        });
    });
});
