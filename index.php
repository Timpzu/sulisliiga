<?php
  require 'scripts/db.php';
  require 'scripts/queries.php';

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
          <table class="game-table singles">
            <tbody>
              <?php
                if ($result_1->num_rows > 0) {
                  $rownum = 1;
                  while($row = $result_1->fetch_assoc()) {
                    $rownum++;
                    echo '
                      <tr>
                        <td class="mt-date">' . $row["date"] . '</td>
                        <td>' . $row["w_name"] . '</td>
                        <td class="mt-score"><strong>' . $row["score"] . '</strong></td>
                        <td>' . $row["l_name"] . '</td>
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
            <?php 
              $file = __DIR__ . '/templates/doubles-template.php';

              $output = '';

              foreach ( $result_2 as $row ){
                $output.= template( $file, $row );
              }

              print $output;
            ?>
          </table>
        </main>
        <div class="right-sidebar">
          <h2>Sarjataulukot</h2>
          <h3>Kaksinpelitaulukko</h3>
          <?php 
            $file = __DIR__ . '/templates/player-template.php';

            $output = '';

            foreach ( $result_3 as $row ){
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
            if ($result_4->num_rows > 0) {
              $rownum = 1;
              while($row = $result_4->fetch_assoc()) {
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
          <h3>Nelinpelitaulukko</h3>
          <table class="standings-table">
            <tr>
              <th>#</th>
              <th>Pelaaja</th>
              <th>Seura</th>
              <th>V</th>
              <th>H</th>
            </tr>
            <?php
            if ($result_5->num_rows > 0) {
              $rownum = 0;
              while($row = $result_5->fetch_assoc()) {
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
        </div>
        <footer>
          <span>Energized by: &nbsp&nbsp</span>
          <img src="public/img/logo-5.svg" alt="" height="80px">
        </footer>
      </div>
    </div>
  </body>
</html>
