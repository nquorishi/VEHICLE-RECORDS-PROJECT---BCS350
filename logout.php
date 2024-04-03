<?php //logout.php
// Naweed Quorishi
// I certify that this submission is my own original work.

/*The script initiates a session, clears the session data, destroys the session, 
and then redirects the user to the login page with a success message indicating a 
successful logout.*/

session_start();

$_SESSION = array();

session_destroy();

header("Location: login.php?success=LogoutSuccessful");
exit();
?>
