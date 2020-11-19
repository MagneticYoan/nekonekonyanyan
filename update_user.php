<?php
    require('connect.php');
    $playerId = $_GET['user'];

    $query = "SELECT id, username, password, admin_lvl, lvl, catnip, cat_id FROM users WHERE id = ?";
	$statement = $pdo->prepare($query);
	$statement->execute([$playerId]);
	$player = $statement->fetch(PDO::FETCH_ASSOC);
	
	require('view_admin_update_user.php');
	