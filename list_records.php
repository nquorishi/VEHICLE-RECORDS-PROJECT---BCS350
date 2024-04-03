<?php //list_records.php
// Naweed Quorishi
// I certify that this submission is my own original work.

/*This script first checks if a user is logged in. If not, it redirects to the login page. 
Then, it connects to the database, retrieves all records from the "vehicles" table, 
and displays them in an HTML table. If there are no records, it displays a message. 
The page includes a link to go back to the main menu.*/

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

$sql = "SELECT * FROM vehicles";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Records</title>
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

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
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
    <h2>List of Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Make</th>
            <th>Model</th>
            <th>Color</th>
            <th>Year</th>
            <th>Price</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["make"] . "</td>";
                echo "<td>" . $row["model"] . "</td>";
                echo "<td>" . $row["color"] . "</td>";
                echo "<td>" . $row["year"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        ?>
    </table>
    <a href="main_menu.php">Back to Main Menu</a>
</body>
</html>
