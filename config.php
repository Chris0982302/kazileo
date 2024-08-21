<?php
$server_name = 'localhost';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$dbname = "election_system";

$conn = new mysqli($server_name, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>