<?php

	include('connect.php');
	
	//get info from the post
	$username = $_POST['username'];
	$password = $_POST['password'];
	$_SESSION['errors'] = '';
	$errors = array();

	//query to check if username is already used
	$query = "SELECT username FROM users WHERE username = ?";
	$statement = $pdo->prepare($query);
	$statement->execute([$username]);
	$user = $statement->fetch(PDO::FETCH_ASSOC);

	//checks errors in form
	if(empty($username) || empty($password)) {
		array_push($errors, 'Username and/or password should not be empty');
	}

	if($username == $user['username']) {
		array_push($errors, 'This username has already been used to sign up.');
	}

	if(strlen($password) < 8 ) {
		array_push($errors, 'Password should be at least 8 caracters long.');
	}
	
	//check if there's errors and insert in ddb
	if(!empty($errors)) {
		var_dump('error is not empty');
		$_SESSION['errors'] = $errors;
		header('Location: inscription.php');

	}
	else {
		var_dump('errors is empty');
		$query2 = "INSERT INTO users (username, password) VALUES (?, ?)";
		$statement2 = $pdo->prepare($query2);
		$statement2->execute([htmlspecialchars($username), password_hash($password, PASSWORD_DEFAULT)]);
		
		//query to check if connections pass are ok
		$query = "SELECT username, admin_lvl, lvl, catnip FROM users WHERE username = ?";
		$statement = $pdo->prepare($query);
		$statement->execute([$username]);
		$user = $statement->fetch(PDO::FETCH_ASSOC);
		
		// set $_SESSION variables
	    $_SESSION['username'] = $user['username'];
	    $_SESSION['admin_lvl'] = $user['admin_lvl'];
	    $_SESSION['lvl'] = $user['lvl'];
	    $_SESSION['catnip'] = $user['catnip'];
	    header('Location: index.php?inscription=ok');
	}
