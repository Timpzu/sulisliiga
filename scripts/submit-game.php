<?php
  include 'db.php';

  // prepare and bind
  $stmt = $mysqli->prepare("INSERT INTO game (date, winner_id, loser_id, score) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("siis", $date, $winner_id, $loser_id, $score);

  $scoreErr = '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $winner_id = $_POST['winner_id'];
    $loser_id = $_POST['loser_id'];

    if (empty($_POST['score'])) {
      $scoreErr = 'Game score is required';
    } else {
      $score = test_input($_POST['score']);
      if (!preg_match('/^\d{2}\s-\s\d{2}$/', $score)) {
        $scoreErr = 'Enter game score in following format: "nn - nn"';
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
