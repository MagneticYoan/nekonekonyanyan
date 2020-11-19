<?php
    include('header.php');
?>

<main id="update_user">
    <form action="controller_admin_update_user.php" method="post">
        
        <fieldset>
            <h3>Update <?php echo $player['username'] ?></h3>
            <label>Username</label>
            <input type="text" id="username" name="username" value="<?php echo $player['username'] ?>">
            <label>Catnip</label>
            <input type="text" id="user_catnip" name="user_catnip" value="<?php echo $player['catnip'] ?>">
            <label>Level</label>
            <input type="text" id="lvl" name="lvl" value="<?php echo $player['lvl'] ?>">
            <label>Admin  (1 = admin)</label>
            <input type="text" id="user_admin" name="user_admin" value="<?php echo $player['admin_lvl'] ?>">
            <label>Fav Cat</label>
            <input type="text" id="favcat" name="favcat" value="<?php echo $player['cat_id'] ?>">
            <input type="hidden" id="id" name="id" value="<?php echo $player['id'] ?>">
            <button type="submit">Update</button>
        </fieldset>
    </form>
</main>

<?php
    include('footer.php');
?>