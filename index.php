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
<html lang="fi">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Nocco Sulisliigan ottelutilastot ja sarjataulukot">
    <title>Nocco Sulisliiga</title>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700" rel="stylesheet">
    <link rel="stylesheet" href="public/css/normalize.css" type="text/css">
    <link rel="stylesheet" href="public/css/styles.css" type="text/css">
  </head>
  <body>
    <div class="wrapper">
      <div class="grid-container">
        <header>
          <h1 class="sr-only">Nocco Sulisliiga</h1>
        </header>
        <main>
          <h2>Ottelutulokset</h2>
          <h3>Kaksinpelitulokset</h3>
          <table class="game-table singles">
            <thead>
              <tr>
                <th>Päivämäärä</th>
                <th>Voittaja</th>
                <th>Tulos</th>
                <th>Häviäjä</th>
              </tr>
            </thead>
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
          <h3>Nelinpelitulokset</h3>
          <table class="game-table doubles">
            <thead>
              <tr>
                <th>Päivämäärä</th>
                <th>Voittajat</th>
                <th>Tulos</th>
                <th>Häviäjät</th>
              </tr>
            </thead>
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
        <section class="right-sidebar" aria-labelledby="standings_heading">
          <h2 id="standings_heading">Sarjataulukot</h2>
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
            <thead>
              <tr>
                <th>#</th>
                <th>Pelaaja</th>
                <th>Seura</th>
                <th>V</th>
                <th>H</th>
              </tr>
            </thead>
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
            <thead>
              <tr>
                <th>#</th>
                <th>Pelaaja</th>
                <th>Seura</th>
                <th>V</th>
                <th>H</th>
              </tr>
            </thead>
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
        </section>
        <footer>
          <p><strong>Sponsored by:</strong></p>
          <a href="admin.php"><img src="public/img/logo-1.svg" alt="Nocco Sulisliiga ylläpito" height="64px"></a>
          <a href="http://acmelogos.com/"><img src="public/img/logo-2.svg" alt="Acme logos website" height="64px"></a>
        </footer>
      </div>
    </div>
  </body>
</html>
