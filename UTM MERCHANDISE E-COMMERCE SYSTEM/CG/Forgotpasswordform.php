<?php
ob_start();
session_start();
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"], input[type="password"], input[type="email"], select {
            width: calc(100% - 2px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid blue;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .optional-fields {
            display: none;
        }
        .spacing {
            margin-bottom: 30px; /* Adjust this value to control spacing */
        }
        .tip {
            font-size: 18px;
            color: #555;
			margin-top: 10px;
            margin-bottom: 10px; /* Added margin for extra spacing */
        }
        .error-message {
            color: red;
            font-size: 18px;
            margin-bottom: 15px; /* Extra space between error message and tip */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Forgot Password</h1>
        <form action="../Function/Sendcode.php" method="post">
            <label for="role">Role:</label>
            <select name="user_type" id="user_type" class="spacing" required>
                <option value="customer">Customer</option>
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
            </select>
            
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" required>
            <small id="emailError" class="error-message"></small>
            <div class="tip">We'll send the verification code to this email.</div>
            <input type="submit" value="Send verification code">
        </form>
    </div>

    <script>
        // Get the email input and the error message element
        const emailInput = document.getElementById("email");
        const emailError = document.getElementById("emailError");

        // Regular expression for a basic email pattern
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        // Add event listener to email input field to validate in real-time
        emailInput.addEventListener("input", function() {
            const emailValue = emailInput.value;

            // Clear the error message if the input is empty
            if (emailValue === "") {
                emailError.textContent = "";
            }
            // Check if email input matches the pattern
            else if (!emailPattern.test(emailValue)) {
                emailError.textContent = "Not a valid email address";
            } else {
                emailError.textContent = ""; // Clear the error when valid
            }
        });
    </script>
</body>
</html>
