<?php //add_records.php
// Naweed Quorishi
// I certify that this submission is my own original work.

/*This script first checks if a user is logged in. If not, it redirects to the login page. 
If the form is submitted, it retrieves input values, sanitizes them, and inserts a 
new record into the "vehicles" table in the database. It then redirects to the main menu 
with a success message if the insertion is successful; otherwise, it redirects back to 
the add_records.php page with an error message.*/

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $make = $_POST["make"];
    $model = $_POST["model"];
    $color = $_POST["color"];
    $year = $_POST["year"];
    $price = $_POST["price"];

    $make = htmlspecialchars($make);
    $model = htmlspecialchars($model);
    $color = htmlspecialchars($color);

    $hn = 'localhost';
    $un = 'userfa23';
    $pw = 'pwdfa23';
    $db = 'bcs350fa23';

    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO vehicles (make, model, color, year, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssid", $make, $model, $color, $year, $price);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: main_menu.php?success=RecordAdded");
        exit();
    } else {
        $stmt->close();
        $conn->close();
        header("Location: add_records.php?error=FailedToAddRecord");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Record</title>
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
            width: 80%;
            max-width: 500px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        a {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h2>Add Records</h2>
    <form action="add_records.php" method="post">
        <label for="make">Make:</label>
        <input type="text" name="make" required>

        <label for="model">Model:</label>
        <input type="text" name="model" required>

        <label for="color">Color:</label>
        <input type="text" name="color" required>

        <label for="year">Year:</label>
        <input type="number" name="year" required>

        <label for="price">Price:</label>
        <input type="text" name="price" required>

        <button type="submit">Add Record</button>
    </form>
    <a href="main_menu.php">Back to Main Menu</a>
</body>
</html>
