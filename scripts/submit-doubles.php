<?php
  include 'db.php';

  // prepare and bind
  $stmt = $mysqli->prepare("INSERT INTO doubles (date, winner1_id, winner2_id, loser1_id, loser2_id, score) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("siiiis", $date, $winner1_id, $winner2_id, $loser1_id, $loser2_id, $score);

  $scoreErr = '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $winner1_id = $_POST['winner1_id'];
    $winner2_id = $_POST['winner2_id'];
    $loser1_id = $_POST['loser1_id'];
    $loser2_id = $_POST['loser2_id'];

    if (empty($_POST['score'])) {
      $scoreErr = 'Match score is required';
    } else {
      $score = test_input($_POST['score']);
      if (!preg_match('/^\d{2}\s-\s\d{2}$/', $score)) {
        $scoreErr = 'Enter match score in following format: "nn - nn"';
      }
    }
    $stmt->execute();
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $stmt->close();
  $mysqli->close();
?>
