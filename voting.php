<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

$user_id = $_SESSION['user_id'];
$level = $_SESSION['level'];
$department = $_SESSION['department'];
$faculty = $_SESSION['faculty'];

$query = "SELECT * FROM participants WHERE level = '$level' AND department = '$department' AND faculty = '$faculty'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  while ($participant = $result->fetch_assoc()) {
    echo '<div>';
    echo '<h2>' . $participant['name'] . '</h2>';
    echo '<img src="' . $participant['picture'] . '">';
    echo '<p>' . $participant['position'] . '</p>';
    echo '<button>Vote</button>';
    echo '</div>';
  }
} else {
  echo 'No participants found';
}
?>