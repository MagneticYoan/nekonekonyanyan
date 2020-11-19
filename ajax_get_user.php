<?php
    require('connect.php');
    
    if(!isset($_SESSION['username'])) {
        $actualUser = '{ "error": "NOT_CONNECTED" }';
    } else {
        $query = 'SELECT catnip, lvl FROM users WHERE username = ?';
        $statement = $pdo->prepare($query);
        $statement->execute([$_SESSION['username']]);
        $actualUser = $statement->fetch(PDO::FETCH_ASSOC);
        $actualUser = json_encode($actualUser);
    }
    
    header('Content-Type: Application/json');
    echo $actualUser;