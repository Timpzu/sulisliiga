$(document).ready(function() {
  // Submit player
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
  // Submit singles form
  $('#submit-singles-form').on('submit', function(e){
    e.preventDefault();
    var date = $('#submit-singles_date').val();
    var winner_id = $('#submit-winner_id').val();
    var loser_id = $('#submit-loser_id').val();
    var score = $('#submit-singles_score').val();

    $.ajax({
      type: "POST",
      url: 'scripts/submit-singles.php',
      data: {date: date, winner_id: winner_id, loser_id: loser_id, score: score},
      dataType: 'json',
    });

    $('input[type="text"], input[type="date"], textarea, select').val('');
  });
  // Submit doubles form
  $('#submit-doubles-form').on('submit', function(e){
    e.preventDefault();
    var date = $('#submit-doubles_date').val();
    var winner1_id = $('#submit-winner1_id').val();
    var winner2_id = $('#submit-winner2_id').val();
    var loser1_id = $('#submit-loser1_id').val();
    var loser2_id = $('#submit-loser2_id').val();
    var score = $('#submit-doubles_score').val();

    $.ajax({
      type: "POST",
      url: 'scripts/submit-doubles.php',
      data: {date: date, winner1_id: winner1_id, winner2_id: winner2_id, loser1_id: loser1_id, loser2_id: loser2_id, score: score},
      dataType: 'json',
    });

    $('input[type="text"], input[type="date"], textarea, select').val('');
  });
});
