<?php //search_records.php
// Naweed Quorishi
// I certify that this submission is my own original work.

/*This script starts by checking if a user is logged in. If not, it redirects to the 
login page. If the form is submitted, it retrieves input values, sanitizes them, and 
performs a search query in the "vehicles" table based on the specified search field and 
value. If results are found, it displays them in a table; otherwise, it shows a message 
indicating no matching records were found.*/

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $searchField = $_POST["searchField"];
    $searchValue = $_POST["searchValue"];

    $searchField = htmlspecialchars($searchField);
    $searchValue = htmlspecialchars($searchValue);

    $hn = 'localhost';
    $un = 'userfa23';
    $pw = 'pwdfa23';
    $db = 'bcs350fa23';

    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM vehicles WHERE $searchField = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $searchValue);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Records</title>
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
            max-width: 500px;
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

        select,
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

        table {
            width: 80%;
            max-width: 800px;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
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
    <h2>Search Records</h2>
    <form action="search_records.php" method="post">
        <label for="searchField">Search Field:</label>
        <select name="searchField">
            <option value="make">Make</option>
            <option value="model">Model</option>
            <option value="color">Color</option>
            <option value="year">Year</option>
            <option value="price">Price</option>
        </select><br>

        <label for="searchValue">Search Value:</label>
        <input type="text" name="searchValue" required><br>

        <button type="submit">Search Records</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($result)) {
        if ($result->num_rows > 0) {
            echo "<h3>Search Results:</h3>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Make</th><th>Model</th><th>Color</th><th>Year</th><th>Price</th></tr>";

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

            echo "</table>";
        } else {
            echo "<p>No matching records found</p>";
        }
    }
    ?>

    <a href="main_menu.php">Back to Main Menu</a>
</body>
</html>
