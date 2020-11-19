<?php
	include('header.php');
?>

	<!--MAIN CONTENT-->
	<p class="inscriptionOk">Only people who has sign up and save their progression can appear here.</p>
	<main id="highscores">
	    <h3>Highscores</h3>
	    
	    <table>
	        <thead>
	            <tr>
	                <td>Rank</td>
	                <td>Nickname</td>
	                <td>Score</td>
	                <td>Level</td>
	            </tr>
	        </thead>
	        <tbody>
	            <?php
	                for($i = 0; $i < count($bestPlayers) ; $i++) {
	                    echo '<tr><td>' . ($i + 1) . '</td>
	                    <td>' . $bestPlayers[$i]['username'] . '</td>
	                    <td>' . $bestPlayers[$i]['catnip'] . '</td>
	                    <td>' . $bestPlayers[$i]['lvl'] . '</td></tr>';
	                }
	            ?>
	        </tbody>
	    </table>
	</main>
	
	
<?php
	include('footer.php');
?>