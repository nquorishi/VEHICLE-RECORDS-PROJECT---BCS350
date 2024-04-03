<?php // setupDB.php
// Naweed Quorishi
// I certify that this submission is my own original work.

/*This script sets up a MySQL database with two tables, 'users' and 'vehicles.' 
It creates the 'users' table with columns for username, email, and password, and 
the 'vehicles' table with columns for vehicle details. It also inserts initial 
vehicle records. The script checks for successful table creation and data 
insertion, providing corresponding success or error messages.*/

$hn = 'localhost';
$un = 'userfa23';
$pw = 'pwdfa23';
$db = 'bcs350fa23';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Fatal Error");
}

$query = "CREATE TABLE IF NOT EXISTS users (
    username VARCHAR(50) PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($query) === TRUE) {
    echo "Table 'users' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

$query = "CREATE TABLE IF NOT EXISTS vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    make VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    color VARCHAR(50) NOT NULL,
    year INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL
)";

if ($conn->query($query) === TRUE) {
    echo "Table 'vehicles' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

$sqlInsert = "INSERT INTO vehicles (make, model, color, year, price) VALUES
    ('Toyota', 'Camry', 'Blue', 2022, 25000),
    ('Honda', 'Civic', 'Red', 2020, 22000),
    ('Ford', 'Fusion', 'Black', 2023, 28000),
    ('Jeep', 'Trackhawk', 'Gray', 2018, 37000),
    ('BMW', 'M5', 'Green', 2019, 78000),
    ('Dodge', 'Durango', 'Gray', 2020, 68000),
    ('Dodge', 'Charger', 'White', 2023, 40000)";

if ($conn->query($sqlInsert) === TRUE) {
    echo "Initial values inserted into vehicles table\n";
} else {
    echo "Error inserting values into vehicles table: " . $conn->error . "\n";
}

$conn->close();
?>
