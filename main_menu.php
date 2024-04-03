<?php //main_menu.php
// Naweed Quorishi
// I certify that this submission is my own original work.

/*This script represents the main menu of a web application. It checks for a user 
session, displays a welcome message with the username, and provides links for 
navigating to different sections such as listing, adding, searching, and deleting 
records, along with a logout option.*/

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu</title>
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

        p {
            margin-top: 0;
            color: #777;
            text-align: center;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
            text-align: center;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
        }

        a.a2 {
            text-decoration: none;
            background-color: #e74c3c;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
        }

        a:hover {
            background-color: #2980b9;
        }

        a.a2:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div>
        <h2>Main Menu</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</p>
        <ul>
            <li><a href="list_records.php">List Records</a></li>
            <li><a href="add_records.php">Add Records</a></li>
            <li><a href="search_records.php">Search Records</a></li>
            <li><a href="delete_records.php">Delete Record</a></li>
            <li><a class="a2" href="logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>
