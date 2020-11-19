<?php

    require('connect.php');
    
    $query="SELECT 
                id, 
                username, 
                catnip, 
                lvl, 
                admin_lvl, 
                cat_id
                FROM users
                ORDER BY username";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $players = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    require('view_admin.php');
