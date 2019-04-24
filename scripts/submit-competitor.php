<?php
  include 'db.php';

  // prepare and bind
  $stmt = $mysqli->prepare("INSERT INTO competitors (first_name, team) VALUES (?, ?)");
  $stmt->bind_param("ss", $first_name, $team);

  // define variables and set to empty values
  $teamErr = $first_nameErr = '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $team = test_input($_POST['team']);
    // check if name only contains letters and whitespace
    if (!preg_match('/^[a-zA-Z]*$/', $team)) {
      $teamErr = 'Only letters are allowed';
    }
    if (empty($_POST['first_name'])) {
      $first_nameErr = 'First name is required';
    } else {
      $first_name = test_input($_POST['first_name']);
      if (!preg_match('/^[^-][a-z-A-Z]*[^-]$/', $first_name)) {
        $first_nameErr = 'Only letters and dash allowed';
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
