<?php //delete_records.php
// Naweed Quorishi
// I certify that this submission is my own original work.

/*This script checks if a user is logged in; if not, it redirects to the login page. 
It then establishes a database connection and processes POST requests to delete records 
from the "vehicles" table based on the provided record ID. The HTML and CSS structure 
the page with a form for user input to enter the record ID for deletion, a button to 
trigger the deletion process, and a link to go back to the main menu. If the deletion 
is successful, it echoes a success message; otherwise, it echoes an error message.*/

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}


$hn = 'localhost';
$un = 'userfa23';
$pw = 'pwdfa23';
$db = 'bcs350fa23';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $record_id = $_POST["record_id"];

    $stmt = $conn->prepare("DELETE FROM vehicles WHERE id = ?");
    $stmt->bind_param("i", $record_id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Record</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            width: 80%;
            max-width: 400px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            text-align: center;
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
            background-color: #e74c3c;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #c0392b;
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
    <h2>Delete Record</h2>
    <form action="delete_records.php" method="post">
        <label for="record_id">Enter Record ID to Delete:</label>
        <input type="number" name="record_id" required><br>

        <button type="submit">Delete Record</button>
    </form>
    <br>
    <a href="main_menu.php">Back to Main Menu</a>
</body>
</html>
