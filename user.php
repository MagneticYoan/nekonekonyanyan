<?php
    include('header.php');
?>

<main id="user">
    <?php
    if (isset($_SESSION['username'])) {
        if (!empty($_SESSION['errors'])) {
			echo '<fieldset class="inscriptionErrors"><h3>Error</h3>';
			foreach($_SESSION['errors'] as $error) {
				echo '<p>' . $error . '</p>';
			}
			echo '</fieldset>';
        
        }
        
        
        echo '<h3>User Options</h3>
        <div class="userUpdateHimself"><form action="controller_user_update_user.php" method="post">
            <label>New Password</label>
            <input type="password" id="password" name="password">
            <input type="hidden" name="modify" value="change_password">
            <button type="submit">Update</button>
        </form>
        <form action="modify_user.php" method="post">';
        foreach($_SESSION['nekos'] as $neko) {
            echo '<fieldset><label for="'. $neko['id'] .'"><img src="img/'. $neko['image'] .'.png" alt="'. $neko['name'] .'"/></label>
                <input type="radio" name="cat" value="'. $neko['id'] .'"></fieldset>';
        }
        echo '<input type="hidden" name="modify" value="change_neko">
        <button type="submit">Update</button></form><div>';
    }
    else {
        echo '<section><p>Please connect before acceding this page</p></section>';
    }
    ?>
    
</main>