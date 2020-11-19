<?php
	require('connect.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>NekoNekoNyanNyan</title>
		<meta charset="utf-8" />
		<link rel="icon" href="img/favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- CSS Vendor -->
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
		<link rel="stylesheet" type="text/css" href="css/normalize.css" media="all" />
		<!-- CSS Perso -->
		<link rel="stylesheet" type="text/css" href="css/base.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
		<!-- JS -->
		<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"> </script>
        <script type="module" src="js/clicker_neko.js"></script>
	</head>
	<body>
		<!--HEADER-->
		<header>
			<a href="index.php">
				<img src = "img/logo.png" alt="Neko Neko Nyan Nyan" />
			</a>
			
			<div class="subtitle">
				<h2>a neko clicker</h2>
				<p>by Yoan</p>
			</div>
			<nav>
				<a href="highscores.php">High Scores</a>
			<?php //show the connexion or not
    		        if(empty($_SESSION['username'])) {
				 echo '<a href="inscription.php">Sign Up</a>
				<a href="connection.php">Sign In</a>';}
				else {
					echo '<a id="saveBtn">Save</a>
					<a href="controller_signout.php">Sign Out</a>
					<a href="user.php">User</a>';
					if($_SESSION['admin_lvl'] == 1) {
						echo '<a href="admin.php">Admin</a>';
					}
					
				} ?>
			</nav>
			<?php
				if (!empty($_GET)) {
					if (array_key_exists('inscription', $_GET)) {
						
						if ($_GET['inscription'] == 'ok') {
							echo '<p class="inscriptionOk">Inscription is done !</p>';
						}
					}
					
					if (array_key_exists('connection', $_GET)) {
					
						if($_GET['connection'] == 'ok') {
							if (!empty($_SESSION['username'])) {
								echo '<p class="inscriptionOk">Hello ' . $_SESSION['username'] . ' !</p>';
							}
						}
						
						if($_GET['connection'] == 'over') {
							echo '<p class="inscriptionOk">Deconnection is done</p>';
						}
					}
				}
				
		?>
		</header>
