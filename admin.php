<?php
  require 'scripts/db.php';

  $sql = "SELECT * FROM player";
  $result = $mysqli->query($sql);
  while ($player[] = mysqli_fetch_object($result));
  array_pop($player);

  $mysqli->close();
?>
<!DOCTYPE html>
<html lang="fi">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Nocco Sulisliigan ylläpitäjän työkalut">
    <title>Ylläpitäjän näkymä | Nocco Sulisliiga </title>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700" rel="stylesheet">
    <link rel="stylesheet" href="public/css/normalize.css" type="text/css">
    <link rel="stylesheet" href="public/css/styles.css" type="text/css">
  </head>
  <body>
    <div class="wrapper">
      <div class="grid-container">
        <header>
          <h1 class="sr-only">Nocco Sulisliiga ylläpitäjän näkymä</h1>
        </header>
        <main>
          <h2>Kirjaa ottelu</h2>
        <!-- Singles form -->
          <h3>Kirjaa kaksinpeli</h3>
          <form id="submit-singles-form" method="post">
            <label for="submit-singles_date">Päivämäärä</label>
            <input type="date" id="submit-singles_date" name="date" required="required">
            <label for="submit-singles_score">Tulos</label>
            <input id="submit-singles_score" type="text" name="score" placeholder="21 - 10" required="required">
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
            <input type="submit" value="Tallenna ottelu">
          </form>
          <!-- Doubles form -->
          <h3>Kirjaa Nelinpeli</h3>
          <form id="submit-doubles-form" method="post">
            <label for="submit-doubles_date">Päivämäärä</label>
            <input type="date" id="submit-doubles_date" name="date" required="required">
            <label for="submit-doubles_score">Tulos</label>
            <input id="submit-doubles_score" type="text" name="score" placeholder="21 - 10" required="required">
            <h4>Voittajat</h4>
            <label for="submit-winner1_id">Voittaja 1</label>
            <select id="submit-winner1_id" name="winner1_id" required="required">
              <?php foreach ( $player as $playa ) : ?>
                <option value="<?php echo $playa->player_id; ?>"><?php echo $playa->firstname; ?></option>
              <?php endforeach; ?>
            </select>
            <label for="submit-winner2_id">Voittaja 2</label>
            <select id="submit-winner2_id" name="winner2_id" required="required">
              <?php foreach ( $player as $playa ) : ?>
                <option value="<?php echo $playa->player_id; ?>"><?php echo $playa->firstname; ?></option>
              <?php endforeach; ?>
            </select>
            <h4>Häviäjät</h4>
            <label for="submit-loser1_id">Häviäjä 1</label>
            <select id="submit-loser1_id" name="loser1_id" required="required">
              <?php foreach ( $player as $playa ) : ?>
                <option value="<?php echo $playa->player_id; ?>"><?php echo $playa->firstname; ?></option>
              <?php endforeach; ?>
            </select>
            <label for="submit-loser2_id">Häviäjä 2</label>
            <select id="submit-loser2_id" name="loser2_id" required="required">
              <?php foreach ( $player as $playa ) : ?>
                <option value="<?php echo $playa->player_id; ?>"><?php echo $playa->firstname; ?></option>
              <?php endforeach; ?>
            </select>
            <input type="submit" value="Tallenna ottelu">
          </form>
        </main>
        <section class="right-sidebar" aria-labelledby="submit_player_heading">
          <h2 id="submit_player_heading">Lisää uusi pelaaja</h2>
          <form id="submit-player-form" method="post">
            <label for="submit_player_firstname">Etunimi</label>
            <input id="submit_player_firstname" type="text" name="firstname" placeholder="Matti" required="required">
            <label for="submit_player_lastname">Sukunimi</label>
            <input id="submit_player_lastname" type="text" name="lastname" placeholder="Meikäläinen">
            <label for="submit_player_club">Kerho</label>
            <input id="submit_player_club" type="text" name="club" placeholder="KaMa">
            <input type="submit" value="Tallenna pelaaja">
          </form>
        </section>
        <footer>
          <p><strong>Sponsored by:</strong></p>
          <a href="index.php"><img src="public/img/logo-1.svg" alt="Nocco Sulisliiga ylläpito" height="50px"></a>
          <a href="http://acmelogos.com/"><img src="public/img/logo-2.svg" alt="Acme logos website" height="50px"></a>
        </footer>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="public/js/submit.js"></script>
  </body>
</html>
