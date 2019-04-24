<?php
  require 'scripts/db.php';

  $sql = "SELECT * FROM competitors";

  $result = $mysqli->query($sql);

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
    <title>Sulisliiga</title>
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

        </main>
        <div class="right-sidebar">
          <h2>Sarjataulukot</h2>
          <h3>Kaksipeli</h3>
          <!-- <div class="standings-leader">
            <div class="sl-content">
              <img class="sl-img" src="public/img/profile.png" alt="" height="100%">
              <img class="sl-logo" src="public/img/apv_logo.png" alt="" height="120px">
              <span class="sl-number">1</span>
              <div class="sl-statistics">
                <span class="sl-name">Matti</span>
                <span>APV</span>
                <span>V: 40 H: 1</span>
              </div>
            </div>
          </div> -->
          <table class="standings-table">
            <tr>
              <th>#</th>
              <th>Pelaaja</th>
              <th>Joukkue</th>
              <th>V</th>
              <th>H</th>
            </tr>
            <tr>
              <td class="index">1.</td>
              <td></td>
              <td></td>
              <td><strong></strong></td>
              <td><strong></strong></td>
            </tr>
          </table>
          <!-- <h3>Nelinpeli</h3>
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
              <td class="index">3.</td>
              <td>Katariina & Mikko</td>
              <td><strong>11</strong></td>
              <td><strong>8</strong></td>
            </tr>
          </table> -->
        </div>
        <footer>
          <span>Energized by: &nbsp&nbsp</span>
          <img src="public/img/logo-5.svg" alt="" height="80px">
        </footer>
      </div>
    </div>
  </body>
</html>
