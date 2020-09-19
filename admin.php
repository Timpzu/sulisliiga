<?php
  require 'scripts/db.php';

  $sql = "SELECT * FROM player";
  $result = $mysqli->query($sql);
  while ($player[] = mysqli_fetch_object($result));
  array_pop($player);

  $mysqli->close();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ylläpitäjän näkymä | Nocco Sulisliiga </title>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700" rel="stylesheet">
    <link rel="stylesheet" href="public/css/normalize.css" type="text/css">
    <link rel="stylesheet" href="public/css/styles.css" type="text/css">
  </head>
  <body>
    <div class="wrapper">
      <div class="grid-container">
        <header>
        </header>
        <main>
          <h2>Kirjaa kaksinpeli</h2>
          <?php
            while($row = $result->fetch_assoc()) {
              echo '<p>' . $row['firstname'] . '</p>';
            }
          ?>
          <form id="submit-game-form" method="post">
            <label for="submit-date">Päivämäärä</label>
            <input type="date" id="submit-date" name="date" required="required">
            <label for="submit-winner_id">Voittaja</label>
            <select id="submit-winner_id" name="winner_id" required="required">
              <?php foreach ( $player as $playa ) : ?>
                <option value="<?php echo $playa->player_id; ?>"><?php echo $playa->firstname; ?></option>
              <?php endforeach; ?>
            </select>
            <label for="submit-loser_id">Häviäjä</label>
            <select id="submit-loser_id" name="loser_id" required="required">
              <?php foreach ( $player as $playa ) : ?>
                <option value="<?php echo $playa->player_id; ?>"><?php echo $playa->firstname; ?></option>
              <?php endforeach; ?>
            </select>
            <label for="submit-score">Tulos</label>
            <input id="submit-score" type="text" name="score" placeholder="21 - 10" required="required">
            <input type="submit" value="Tallenna ottelu">
          </form>
        </main>
        <div class="right-sidebar">
          <h2>Lisää uusi pelaaja</h2>
          <form id="submit-player-form" method="post">
            <label for="submit_player_firstname">Etunimi</label>
            <input id="submit_player_firstname" type="text" name="firstname" placeholder="Matti" required="required">
            <label for="submit_player_lastname">Sukunimi</label>
            <input id="submit_player_lastname" type="text" name="lastname" placeholder="Meikäläinen">
            <label for="submit_player_club">Kerho</label>
            <input id="submit_player_club" type="text" name="club" placeholder="KaMa">
            <input type="submit" value="Tallenna pelaaja">
          </form>
        </div>
        <footer>
          <span>Energized by: &nbsp&nbsp</span>
          <img src="public/img/logo-5.svg" alt="" height="80px">
        </footer>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="public/js/submit.js"></script>
  </body>
</html>
