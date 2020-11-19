<?php
    
    require('connect.php');
    
    $queryCats = "
        SELECT id, name, show_min, show_max, image, catnip, price
        FROM neko";
    
    $statement = $pdo->prepare($queryCats);
    $statement->execute();
    $neko = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($neko);
    header('Content-Type: Application/json');
    