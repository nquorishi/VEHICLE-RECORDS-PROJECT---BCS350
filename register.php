<?php //register.php
// Naweed Quorishi
// I certify that this submission is my own original work.

/*This code creates a user registration form. It includes fields for email, username, 
password, and confirm password. The styling features a centered layout with a clean 
design, and it provides a link to the login page for users who already have an account. 
The form is submitted to "register_process.php" for further processing.*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        p {
            margin-top: 20px;
            text-align: center;
            color: #777;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div>
        <h2>User Registration</h2>
        <form action="register_process.php" method="post" onsubmit="return validateForm()">
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="username">Username:</label>
            <input type="text" name="username" minlength="6" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" minlength="8" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" minlength="8" required>

            <button type="submit">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
