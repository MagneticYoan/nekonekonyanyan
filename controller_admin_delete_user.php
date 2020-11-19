<?php
    require('connect.php');
    
    $userId = $_GET['user'];
    
    $query = "DELETE FROM `users` WHERE `id` = ?";
        
    $statement = $pdo->prepare($query);
    $statement->execute([$userId]);
    
    header('Location: admin.php');