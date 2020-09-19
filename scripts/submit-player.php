<?php
  include 'db.php';

  // prepare and bind
  $stmt = $mysqli->prepare("INSERT INTO player (firstname, lastname, club) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $firstname, $lastname, $club);

  // define variables and set to empty values
  $clubErr = $firstnameErr = '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $club = test_input($_POST['club']);
    // check if name only contains letters and whitespace
    if (!preg_match('/^[a-zA-Z]*$/', $club)) {
      $clubErr = 'Only letters are allowed';
    }
    if (empty($_POST['firstname'])) {
      $firstnameErr = 'First name is required';
    } else {
      $firstname = test_input($_POST['firstname']);
      if (!preg_match('/^[^-][a-z-A-Z]*[^-]$/', $firstname)) {
        $firstnameErr = 'Only letters and dash allowed';
      }
    }
    if (empty($_POST['lastname'])) {
      $lastnameErr = 'Last name is required';
    } else {
      $lastname = test_input($_POST['lastname']);
      if (!preg_match('/^[^-][a-z-A-Z]*[^-]$/', $lastname)) {
        $lastnameErr = 'Only letters and dash allowed';
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
