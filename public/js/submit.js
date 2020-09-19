$(document).ready(function() {
  $('#submit-player-form').on('submit', function(e){
    e.preventDefault();
    var firstname = $('#submit_player_firstname').val();
    var lastname = $('#submit_player_lastname').val();
    var club = $('#submit_player_club').val();

    $.ajax({
      type: "POST",
      url: 'scripts/submit-player.php',
      data: {firstname: firstname, lastname: lastname, club: club},
      dataType: 'json'
    });
    $('input[type="text"],textarea').val('');
  });
  $('#submit-game-form').on('submit', function(e){
    e.preventDefault();
    var date = $('#submit-date').val();
    var winner_id = $('#submit-winner_id').val();
    var loser_id = $('#submit-loser_id').val();
    var score = $('#submit-score').val();

    $.ajax({
      type: "POST",
      url: 'scripts/submit-game.php',
      data: {date: date, winner_id: winner_id, loser_id: loser_id, score: score},
      dataType: 'json',
      success: function() {
        window.location.reload();
      }
    });

    $('input[type="text"], input[type="date"], textarea, select').val('');
  });
});
