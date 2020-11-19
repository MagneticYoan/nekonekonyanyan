<?php
	//connection to bdd
	include('connect.php');
	
	//get info from post
	$username = $_POST['username'];
	$password = $_POST['password'];


	//query to check if connections pass are ok
	$query = "SELECT username, password, admin_lvl, lvl, catnip FROM users WHERE username = ?";
	$statement = $pdo->prepare($query);
	$statement->execute([$username]);
	$user = $statement->fetch(PDO::FETCH_ASSOC);
	
	// set $_SESSION variables
	if ($user['username'] == $username && password_verify($password, $user['password'])) {
	    $_SESSION['username'] = $user['username'];
	    $_SESSION['admin_lvl'] = $user['admin_lvl'];
	    $_SESSION['lvl'] = $user['lvl'];
	    $_SESSION['catnip'] = $user['catnip'];
	    header('Location: index.php?connection=ok');
	}
	else {
		header('Location: connection.php?connection=fail');
	}
