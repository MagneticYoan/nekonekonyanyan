<?php

    require('connect.php');
    
    $query="SELECT username, catnip, lvl FROM users ORDER BY catnip DESC LIMIT 10";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $bestPlayers = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    require('view_highscores.php');
