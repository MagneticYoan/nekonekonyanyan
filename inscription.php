<?php
	include('header.php');
?>

		<!--MAIN CONTENT-->
		<main class="form">
			
			<form action="controller_inscription.php" method="post">
				<?php
				if (!empty($_SESSION['errors'])) {
					echo '<fieldset class="inscriptionErrors"><h3>Error</h3>';
					foreach($_SESSION['errors'] as $error) {
						echo '<p>' . $error . '</p>';
					}
					echo '</fieldset>';
				}
				
				?>
				<fieldset>
					<h3>Inscription</h3>
					<div>
						<label for="username">Username</label>
						<input type="text" name="username" id="username"/>
					</div>
					<div>
						<label for="password">Password</label>
						<input type="password" name="password" id="password"/>
					</div>
					<button type="submit">Validate</button>
				</fieldset>

		</main>
<?php
	include('footer.php');
?>