<?php

    require('connect.php');
    
    var_dump($_GET);

    if($_POST['modify'] = 'password') {
        $username = $_SESSION['username'];
	    $password = $_POST['password'];
	    $errors = array();
	    
	    if(empty($password)) {
    		array_push($errors, 'Password should not be empty');
    	}
    
    	if(strlen($password) < 8 ) {
    		array_push($errors, 'Password should be at least 8 caracters long.');
    	}
    	
    	if(!empty($errors)) {
    		var_dump('error is not empty');
    		$_SESSION['errors'] = $errors;
    		header('Location: user.php');
    
    	}
    	else {
    		$query = "UPDATE users SET password = ? WHERE username = ?";
    		$statement = $pdo->prepare($query);
    		$statement->execute([password_hash($password, PASSWORD_DEFAULT), htmlspecialchars($username)]);
    		
    		header('Location: user.php?modify=ok');
    	}
    }
    
    if($_POST['modify'] = 'neko') {
        $errors = array();
        $_SESSION['errors'] = $errors;
        $username = $_SESSION['username'];
        $likedCat = $_POST['cat'];
        
		$query = "UPDATE users SET cat_id = ? WHERE username = ?";
		$statement = $pdo->prepare($query);
		$statement->execute([$likedCat, htmlspecialchars($username)]);
		
		$_SESSION['neko'] = $likedCat;
		
		header('Location: user.php?modify=ok');

    }