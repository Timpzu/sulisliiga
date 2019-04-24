<?php
  require 'scripts/db.php';

  $sql = "SELECT * FROM competitors";
  $result = $mysqli->query($sql);
  while ($competitors[] = mysqli_fetch_object($result));
  array_pop($competitors);

  $mysqli->close();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sulisliiga - Ylläpitäjän näkymä</title>
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
          <h1>Sulisliiga - Ylläpitäjän työkalut</h1>
          <h2>Kirjaa ottelu</h2>
          <?php
            while($row = $result->fetch_assoc()) {
              echo '<p>' . $row['first_name'] . '</p>';
            }
          ?>
          <form id="submit-match-form" method="post">
            <label for="submit-match-competitor_id_1">Pelaaja 1</label>
            <select id="submit-match-competitor_id_1" name="competitor_id_1" required="required">
              <?php foreach ( $competitors as $competitor ) : ?>
                <option value="<?php echo $competitor->competitor_id; ?>"><?php echo $competitor->first_name; ?></option>
              <?php endforeach; ?>
            </select>
            <label for="submit-match-competitor_id_2">Pelaaja 2</label>
            <select id="submit-match-competitor_id_2" name="competitor_id_2" required="required">
              <?php foreach ( $competitors as $competitor ) : ?>
                <option value="<?php echo $competitor->competitor_id; ?>"><?php echo $competitor->first_name; ?></option>
              <?php endforeach; ?>
            </select>
            <label for="submit-match-winner_competitor_id">Voittaja</label>
            <select id="submit-match-winner_competitor_id" name="winner_competitor_id" required="required">
              <?php foreach ( $competitors as $competitor ) : ?>
                <option value="<?php echo $competitor->competitor_id; ?>"><?php echo $competitor->first_name; ?></option>
              <?php endforeach; ?>
            </select>
            <label for="submit-match-match_score">Tulos</label>
            <input id="submit-match-match_score" type="text" name="match_score" required="required">
            <input type="submit" value="Tallenna ottelu">
          </form>
        </main>
        <div class="right-sidebar">
          <h2>Lisää uusi pelaaja</h2>
          <form id="submit-competitor-form" method="post">
            <label for="submit_competitor_first_name">Etunimi</label>
            <input id="submit_competitor_first_name" type="text" name="first_name" required="required">
            <label for="submit_competitor_team">Joukkue</label>
            <input id="submit_competitor_team" type="text" name="team">
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
