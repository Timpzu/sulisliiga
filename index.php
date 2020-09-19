<?php
  require 'scripts/db.php';

  $sql = "SELECT g.date, g.score, wp.firstname AS w_name, lp.firstname AS l_name   
          FROM game g 
          LEFT JOIN player wp ON g.winner_id = wp.player_id 
          LEFT JOIN player lp ON g.loser_id = lp.player_id ORDER BY g.date DESC LIMIT 0, 10";

  $sql_2 = "SELECT p.firstname, p.club, 
            (SELECT COUNT(*) 
            FROM game g 
            WHERE p.player_id = g.loser_id
            ) AS loses,
            (SELECT COUNT(*) 
            FROM game g 
            WHERE p.player_id = g.winner_id
            ) AS wins
            FROM player p ORDER BY wins DESC LIMIT 1";

$sql_3 = "SELECT p.firstname, p.club, 
          (SELECT COUNT(*) 
          FROM game g 
          WHERE p.player_id = g.loser_id
          ) AS loses,
          (SELECT COUNT(*) 
          FROM game g 
          WHERE p.player_id = g.winner_id
          ) AS wins
          FROM player p ORDER BY wins DESC LIMIT 1,10";

  $result = $mysqli->query($sql);
  $result_2 = $mysqli->query($sql_2);
  $result_3 = $mysqli->query($sql_3);

  function template( $file, $args ){
    // ensure the file exists
    if ( !file_exists( $file ) ) {
      return '';
    }
    // Make values in the associative array easier to access by extracting them
    if ( is_array( $args ) ){
      extract( $args );
    }
    // buffer the output (including the file is "output")
    ob_start();
    include $file;
    return ob_get_clean();
  }

  $mysqli->close();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Nocco Sulisliiga</title>
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
          <h2>Ottelut</h2>
          <h3>Kaksinpelit</h3>
          <table class="game-table">
            <tbody>
              <?php
                if ($result->num_rows > 0) {
                  $rownum = 1;
                  while($row = $result->fetch_assoc()) {
                    $rownum++;
                    echo '
                      <tr>
                        <td class="mt-date">' . $row["date"] . '</td>
                        <td align="left">' . $row["w_name"] . '</td>
                        <td align="center" class="mt-score"><strong>' . $row["score"] . '</strong></td>
                        <td align="right">' . $row["l_name"] . '</td>
                      </tr>
                    ';
                  }
                } else {
                  echo "0 results";
                }
              ?>
            </tbody>
          </table>
          <h3>Nelinpelit</h3>
          <table class="game-table doubles">
          <tbody>
            <tr>
              <td class="mt-date">24.4.2019</td>
              <td align="left">Matti</td>
              <td align="center" class="mt-score"><strong>21 - 0</strong></td>
              <td align="right">Mikko</td>
            </tr>
            <tr>
              <td class="mt-date">24.4.2019</td>
              <td align="left">Matti</td>
              <td align="center" class="mt-score"><strong>21 - 0</strong></td>
              <td align="right">Mikko</td>
            </tr>
          </tbody>
          </table>
        </main>
        <div class="right-sidebar">
          <h2>Sarjataulukot</h2>
          <h3>Kaksipeli</h3>
          <?php 
            $file = __DIR__ . '/templates/player-template.php';

            $output = '';

            foreach ( $result_2 as $row ){
              $output.= template( $file, $row );
            }

            print $output;
          ?>
          <table class="standings-table">
            <tr>
              <th>#</th>
              <th>Pelaaja</th>
              <th>Seura</th>
              <th>V</th>
              <th>H</th>
            </tr>
            <?php
            if ($result_3->num_rows > 0) {
              $rownum = 1;
              while($row = $result_3->fetch_assoc()) {
                $rownum++;
                echo '
                  <tr>
                    <td class="index">' . $rownum . '.</td>
                    <td>' . $row["firstname"] . '</td>
                    <td>' . $row["club"] . '</td>
                    <td><strong>' . $row["wins"] . '</strong></td>
                    <td><strong>' . $row["loses"] . '</strong></td>
                  </tr>
                ';
              }
            } else {
              echo "0 results";
            }
            ?>
          </table>
          <h3>Nelinpeli</h3>
          <table class="standings-table">
            <tr>
              <th>#</th>
              <th>Joukkue</th>
              <th>V</th>
              <th>H</th>
            </tr>
            <tr>
            <tr>
              <td class="index">1.</td>
              <td>Maria & Matti</td>
              <td><strong>22</strong></td>
              <td><strong>1</strong></td>
            </tr>
              <td class="index">2.</td>
              <td>Mikko & Minna</td>
              <td><strong>15</strong></td>
              <td><strong>5</strong></td>
            </tr>
            <tr>
              <td class="index">3.</td>
              <td>Helena & Johannes</td>
              <td><strong>12</strong></td>
              <td><strong>7</strong></td>
            </tr>
            <tr>
              <td class="index">4.</td>
              <td>Katariina & Mikko</td>
              <td><strong>11</strong></td>
              <td><strong>8</strong></td>
            </tr>
          </table>
        </div>
        <footer>
          <span>Energized by: &nbsp&nbsp</span>
          <img src="public/img/logo-5.svg" alt="" height="80px">
        </footer>
      </div>
    </div>
  </body>
</html>
