<?php
  include 'db.php';

  // prepare and bind
  $stmt = $mysqli->prepare("INSERT INTO matches (competitor_id_1, competitor_id_2, winner_competitor_id, match_score) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("iiis", $competitor_id_1, $competitor_id_2, $winner_competitor_id, $match_score);

  $match_scoreErr = '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $competitor_id_1 = $_POST['competitor_id_1'];
    $competitor_id_2 = $_POST['competitor_id_2'];
    $winner_competitor_id = $_POST['winner_competitor_id'];

    if (empty($_POST['match_score'])) {
      $match_scoreErr = 'Match score is required';
    } else {
      $match_score = test_input($_POST['match_score']);
      if (!preg_match('/^\d{2}\s-\s\d{2}$/', $match_score)) {
        $match_scoreErr = 'Enter match score in following format: "nn - nn"';
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
