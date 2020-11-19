<?php
    require('connect.php');
    $user = $_GET;
    var_dump($user);
    $userCatnip = $user['catnip'];
    $userLvl = $user['lvl'];

    $query = 'UPDATE users SET catnip = ?, lvl = ? WHERE username = ?';
    $statement = $pdo->prepare($query);
	$statement->execute([$userCatnip, $userLvl, $_SESSION['username']]);
	
	var_dump($userCatnip);