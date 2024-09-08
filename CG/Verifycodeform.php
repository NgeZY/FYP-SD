<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
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
        input[type="text"], input[type="password"], input[type="email"], input[type="number"] {
            width: calc(100% - 2px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
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
        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .checkbox-container input[type="checkbox"] {
            margin-right: 10px;
        }
        .checkbox-container label {
            margin: 0;
            font-size: 16px;
        }
    </style>
    <script>
        function togglePasswordVisibility() {
            var newPasswordField = document.getElementById("new_password");
            var confirmPasswordField = document.getElementById("confirm_password");
            var checkbox = document.getElementById("show_password");

            if (checkbox.checked) {
                newPasswordField.type = "text";
                confirmPasswordField.type = "text";
            } else {
                newPasswordField.type = "password";
                confirmPasswordField.type = "password";
            }
        }
    </script>
</head>
<body>
	<?php
	session_start();
	?>
    <div class="container">
        <h1>Verification</h1>
        <form action="../Function/Verifycode.php" method="post">
            <label for="verification_code">Verification code:</label>
            <input type="number" name="verification_code" id="verification_code" required>

            <label for="new_password">New password:</label>
            <input type="password" name="new_password" id="new_password" required>

            <label for="confirm_password">Confirm the password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>

            <div class="checkbox-container">
                <input type="checkbox" id="show_password" onclick="togglePasswordVisibility()">
                <label for="show_password">Show passwords</label>
            </div>

            <input type="submit" value="Change password">
        </form>
    </div>
</body>
</html>
