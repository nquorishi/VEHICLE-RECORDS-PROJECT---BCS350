<?php //register_process.php
// Naweed Quorishi
// I certify that this submission is my own original work.

/*This script handles user registration. It receives data from a POST request 
(email, username, password, confirm_password), validates the data, and checks if 
the username and email are already in use. If the data is valid and unique, it hashes 
the password and inserts the user into the "users" table. If any errors occur during 
this process, it redirects back to the registration form with an appropriate error 
message. If the registration is successful, it redirects to the main menu.*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($email) || empty($username) || empty($password) || empty($confirm_password) || $password !== $confirm_password) {
        header("Location: register.php?error=InvalidData");
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

    $check_username_stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $check_username_stmt->bind_param("s", $username);
    $check_username_stmt->execute();
    $check_username_result = $check_username_stmt->get_result();

    $check_email_stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check_email_stmt->bind_param("s", $email);
    $check_email_stmt->execute();
    $check_email_result = $check_email_stmt->get_result();

    if ($check_username_result->num_rows > 0) {
        $check_username_stmt->close();
        $check_email_stmt->close();
        $conn->close();
        header("Location: register.php?error=UsernameInUse");
        exit();
    }

    if ($check_email_result->num_rows > 0) {
        $check_username_stmt->close();
        $check_email_stmt->close();
        $conn->close();
        header("Location: register.php?error=EmailInUse");
        exit();
    }

    $check_username_stmt->close();
    $check_email_stmt->close();

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $insert_stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $insert_stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($insert_stmt->execute()) {
        $insert_stmt->close();
        $conn->close();
        header("Location: main_menu.php");
        exit();
    } else {
        $insert_stmt->close();
        $conn->close();
        header("Location: register.php?error=RegistrationFailed");
        exit();
    }
} else {
    header("Location: register.php");
    exit();
}
?>
