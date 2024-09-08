<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
        .password-container {
            margin-bottom: 10px;
        }
        .checkbox-container {
            display: flex;
            align-items: center;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .checkbox-container input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.2);
        }
        .checkbox-container label {
            margin: 0;
        }
        .spacing {
            margin-bottom: 30px;
        }
        .error-message {
            color: red;
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="../Function/Signin.php" method="post">
            <label for="role">Role:</label>
            <select name="role" id="role" class="spacing" required>
                <option value="customer">Customer</option>
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
            </select>

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" required>
            <small id="emailError" class="error-message"></small>
			<p id="emailError"></p>
            
            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" name="password" id="password" required>
            </div>
            <div class="checkbox-container">
                <input type="checkbox" id="toggle-password">
                <label for="toggle-password">Show password</label>
            </div>
            
            <a href="Forgotpasswordform.php">Forgot password?</a><br><br>
            <a href="Signupform.html">Don't have an account yet? Sign up</a><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
    <script>
        // Toggle password visibility
        document.getElementById('toggle-password').addEventListener('change', function() {
            const passwordInput = document.getElementById('password');
            passwordInput.type = this.checked ? 'text' : 'password';
        });

        // Email validation
        const emailInput = document.getElementById("email");
        const emailError = document.getElementById("emailError");

        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

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
