<?php
require_once 'config.php';

if (isset($_POST['vote'])) {
  $user_id = $_SESSION['user_id'];
  $participant_id = $_POST['participant_id'];
  $position = $_POST['position'];

  $query = "INSERT INTO votes (user_id, participant_id, position) VALUES ('$user_id', '$participant_id', '$position')";
  $conn->query($query);

  echo 'Vote cast successfully!';
} else {
  echo 'Error casting vote';
}
?>