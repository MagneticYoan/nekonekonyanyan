<?php 
    require('connect.php');
    
    $username = $_POST['username'];
    $id = $_POST['id'];
    $catnip = $_POST['user_catnip'];
    $lvl = $_POST['lvl'];
    $admin = $_POST['user_admin'];
    $favcat = $_POST['favcat'];
    
    if(!$favcat) {
    	$favcat = 1;
    }
    
    $errors = array();
    
    $query = "SELECT username FROM users WHERE username = ?";
	$statement = $pdo->prepare($query);
	$statement->execute([$username]);
	$user = $statement->fetch(PDO::FETCH_ASSOC);
    
    if(!$user) {
		array_push($errors, 'This username is already used.');
	}
	
	if(!empty($errors)) {
		var_dump('error is not empty');
		$_SESSION['errors'] = $errors;
		header('Location: update_user_override.php?' . $id);

	}
	else {
		$query = "UPDATE users 
		        SET username = ?,
		        catnip = ?,
		        lvl = ?,
		        admin_lvl = ?,
		        cat_id = ?
		        WHERE username = ?";
		$statement = $pdo->prepare($query);
		$statement->execute([htmlspecialchars($username), htmlspecialchars($catnip), htmlspecialchars($lvl), htmlspecialchars($admin), htmlspecialchars($favcat), htmlspecialchars($username)]);
		
		header('Location: admin.php');
	}