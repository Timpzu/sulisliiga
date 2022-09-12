<?php
  function check_image_exists($url, $default) {
    $url = trim($url);
    $info = @getimagesize($url);
    if ((bool) $info) {
      return $url;
    } else {
      return $default;
    }
  }

  $test_player_image = "public/img/player/" . $firstname . ".png";
  $default_player_image = "public/img/player/profile.png";

  $test_club_image = "public/img/club/". $club .".png";
  $default_club_image = "public/img/club/APV.png";
?>

<div class="standings-leader">
  <div class="sl-content">
    <img class="sl-img" src="<?php echo check_image_exists($test_player_image, $default_player_image); ?>" alt="" height="100%">
    <img class="sl-logo" src="<?php echo check_image_exists($test_club_image, $default_club_image); ?>" alt="" height="120px">
    <span class="sl-number">1</span>
    <div class="sl-statistics">
      <span class="sl-name"><?php echo $firstname ?></span>
      <span><?php echo $club ?></span>
      <span>V: <?php echo $wins ?> H: <?php echo $loses ?></span>
    </div>
  </div>
</div>