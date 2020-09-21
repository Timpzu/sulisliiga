<?php
    $sql_1 = 
        "SELECT DATE_FORMAT(s.date, '%e.%c.%Y') AS date, s.score, winner.firstname AS w_name, loser.firstname AS l_name   
        FROM singles s 
        LEFT JOIN player winner ON s.winner_id = winner.player_id 
        LEFT JOIN player loser ON s.loser_id = loser.player_id ORDER BY s.date DESC LIMIT 0, 10";

    $sql_2 = 
        "SELECT DATE_FORMAT(d.date, '%e.%c.%Y') AS date, d.score, 
        winner1.firstname AS winner1_name, winner2.firstname AS winner2_name, loser1.firstname AS loser1_name, loser2.firstname AS loser2_name
        FROM doubles d 
        LEFT JOIN player winner1 ON d.winner1_id = winner1.player_id
        LEFT JOIN player winner2 ON d.winner2_id = winner2.player_id
        LEFT JOIN player loser1 ON d.loser1_id = loser1.player_id
        LEFT JOIN player loser2 ON d.loser2_id = loser2.player_id ORDER BY d.date DESC LIMIT 0, 10";

    $sql_3 = 
        "SELECT p.firstname, p.club, 
        (SELECT COUNT(*) 
        FROM singles s 
        WHERE p.player_id = s.loser_id
        ) AS loses,
        (SELECT COUNT(*) 
        FROM singles s 
        WHERE p.player_id = s.winner_id
        ) AS wins
        FROM player p ORDER BY wins DESC LIMIT 1";

    $sql_4 = 
        "SELECT p.firstname, p.club, 
        (SELECT COUNT(*) 
        FROM singles s 
        WHERE p.player_id = s.loser_id
        ) AS loses,
        (SELECT COUNT(*) 
        FROM singles s 
        WHERE p.player_id = s.winner_id
        ) AS wins
        FROM player p ORDER BY wins DESC LIMIT 1,10";

    $sql_5 = 
        "SELECT p.firstname, p.club, 
        (SELECT COUNT(*) 
        FROM doubles d 
        WHERE p.player_id = d.loser1_id
        ) +
        (SELECT COUNT(*) 
        FROM doubles d 
        WHERE p.player_id = d.loser2_id
        ) AS loses,
        (SELECT COUNT(*) 
        FROM doubles d 
        WHERE p.player_id = d.winner1_id
        ) +
        (SELECT COUNT(*) 
        FROM doubles d 
        WHERE p.player_id = d.winner2_id
        ) AS wins
        FROM player p ORDER BY wins DESC, loses LIMIT 10";

    $result_1 = $mysqli->query($sql_1);
    $result_2 = $mysqli->query($sql_2);
    $result_3 = $mysqli->query($sql_3);
    $result_4 = $mysqli->query($sql_4);
    $result_5 = $mysqli->query($sql_5);

    $mysqli->close();
?>