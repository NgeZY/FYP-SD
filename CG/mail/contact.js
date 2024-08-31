$(function () {
    // Initialize form validation
    $("#contactForm input, #contactForm textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function ($form, event, errors) {
            console.log("Validation errors:", errors);
        },
        submitSuccess: function ($form, event) {
            event.preventDefault();

            var name = $("input#name").val();
            var email = $("input#email").val();
            var subject = $("input#subject").val();
            var message = $("textarea#message").val();

            var $this = $("#sendMessageButton");
            $this.prop("disabled", true);

            $.ajax({
                url: "mail/contact.php",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    subject: subject,
                    message: message
                },
                cache: false,
                dataType: "json", // Expect JSON response
                success: function (response) {
                    console.log("Response received:", response); // Log the response
                    if (response.status === 'success') {
                        alert(response.message);
                        window.location.reload(); // Reload the page
                    } else {
                        alert("Sorry " + name + ", there's an error submitting the message. Please try again later!");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown);
                    console.error("Response text:", jqXHR.responseText); // Log response text
                    alert("Sorry " + name + ", there's an error submitting the message. Please try again later!");
                },
                complete: function () {
                    setTimeout(function () {
                        $this.prop("disabled", false);
                    }, 1000);
                }
            });
        },
        filter: function () {
            return $(this).is(":visible");
        }
    });

    $("a[data-toggle=\"tab\"]").click(function (e) {
        e.preventDefault();
        $(this).tab("show");
    });

    $('#name').focus(function () {
        $('#success').html('');
    });
});
