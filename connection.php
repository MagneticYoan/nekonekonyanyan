<?php
	include('header.php');
?>

		<!--MAIN CONTENT-->
		<main class="form">
			<form action="controller_connexion.php" method="post">
				
				<?php
					if(!empty($_GET)) {
						if($_GET['connection'] == 'fail') {
							echo '<fieldset class="inscriptionErrors">
									<h3>Error</h3>
									<p>Error on username and/or password.</p></fieldset>';
						}
					}
				?>
				
				<fieldset>
					<h3>Connection</h3>
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