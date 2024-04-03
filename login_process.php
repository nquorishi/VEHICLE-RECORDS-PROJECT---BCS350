<?php //login_process.php
// Naweed Quorishi
// I certify that this submission is my own original work.

/*This script handles the login process. It starts a session and retrieves the entered 
username and password from the login form. It then checks the database for a matching 
username, verifies the password using password_verify, and if successful, sets a session 
variable for the username and redirects to the main menu. If there's an error or 
invalid credentials, it redirects back to the login page with an error message.*/

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hn = 'localhost';
    $un = 'userfa23';
    $pw = 'pwdfa23';
    $db = 'bcs350fa23';

    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;
            header("Location: main_menu.php");
            exit();
        } else {
            header("Location: login.php?error=InvalidCredentials");
            exit();
        }
    } else {
        header("Location: login.php?error=InvalidCredentials");
        exit();
    }

    $conn->close();
} else {
    header("Location: login.php");
    exit();
}
?>
