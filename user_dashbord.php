<?php
// Check if the user is a user
if ($_SESSION['role'] == 'user') {
    // Display user dashboard content
    echo 'Welcome, User!';
} else {
    // Redirect to login page if not a user
    header('Location: login.php');
    exit;
}
?>