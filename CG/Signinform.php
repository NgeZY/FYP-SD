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
            font-size: 16px; /* Increased font size */
            margin-bottom: 20px;
        }
        .checkbox-container input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.2); /* Makes the checkbox larger */
        }
        .checkbox-container label {
            margin: 0; /* Removes default margin for better alignment */
        }
        .spacing {
            margin-bottom: 30px; /* Adjust this value to control spacing */
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
            
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
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
        document.getElementById('toggle-password').addEventListener('change', function() {
            const passwordInput = document.getElementById('password');
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>
</html>
