$(document).ready(function() {
  $('#submit-competitor-form').on('submit', function(e){
    e.preventDefault();
    var first_name = $('#submit_competitor_first_name').val();
    var team = $('#submit_competitor_team').val();

    $.ajax({
      type: "POST",
      url: 'scripts/submit-competitor.php',
      data: {first_name: first_name, team: team},
      dataType: 'json'
    });
  });
  $('#submit-match-form').on('submit', function(e){
    e.preventDefault();
    var competitor_id_1 = $('#submit-match-competitor_id_1').val();
    var competitor_id_2 = $('#submit-match-competitor_id_2').val();
    var winner_competitor_id = $('#submit-match-winner_competitor_id').val();
    var match_score = $('#submit-match-match_score').val();

    $.ajax({
      type: "POST",
      url: 'scripts/submit-match.php',
      data: {competitor_id_1: competitor_id_1, competitor_id_2: competitor_id_2, winner_competitor_id: winner_competitor_id, match_score: match_score},
      dataType: 'json'
    });
  });
});
