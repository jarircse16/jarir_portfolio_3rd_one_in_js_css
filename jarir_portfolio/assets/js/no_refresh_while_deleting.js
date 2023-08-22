<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#deleteButton").click(function(event) {
            event.preventDefault(); // Prevent default form submission
            $.ajax({
                type: "POST",
                url: "delete_messages.php",
                data: { deleteMessages: true }, // Ensure the 'deleteMessages' parameter is sent
                success: function(response) {
                    $("#response").html(response); // Display response in the specified div
                }
            });
        });
    });
</script>
