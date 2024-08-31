$(function () {
    // Initialize form validation
    $("#contactForm input, #contactForm textarea").jqBootstrapValidation({
        preventSubmit: true, // Prevent the default form submission
        submitError: function ($form, event, errors) {
            // Handle form validation errors if needed
            console.log("Validation errors:", errors);
        },
        submitSuccess: function ($form, event) {
            event.preventDefault(); // Prevent default form submission behavior
            
            var name = $("input#name").val();
            var email = $("input#email").val();
            var subject = $("input#subject").val();
            var message = $("textarea#message").val();

            var $this = $("#sendMessageButton");
            $this.prop("disabled", true); // Disable the submit button

            $.ajax({
                url: "mail/contact.php", // Use relative path here
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    subject: subject,
                    message: message
                },
                cache: false,
                success: function (response) {
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.status === 'success') {
                        // Show success alert
                        alert(jsonResponse.message);
                        $('#contactForm').trigger("reset"); // Reset form fields
                    } else {
                        // Show error alert
                        alert("Sorry " + name + ", there's an error submitting the message. Please try again later!");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Log detailed error information
                    console.log("AJAX Error: ", textStatus, errorThrown);
                    alert("Sorry " + name + ", there's an error submitting the message. Please try again later!");
                },
                complete: function () {
                    setTimeout(function () {
                        $this.prop("disabled", false); // Re-enable the submit button
                    }, 1000);
                }
            });
        },
        filter: function () {
            return $(this).is(":visible");
        }
    });

    // Tab switching behavior
    $("a[data-toggle=\"tab\"]").click(function (e) {
        e.preventDefault();
        $(this).tab("show");
    });

    // Clear success message on focus of the name field
    $('#name').focus(function () {
        $('#success').html('');
    });
});
