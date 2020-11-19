<?php
    include('header.php');
?>

    <main id="admin">
        <?php
            if(isset($_SESSION) && $_SESSION['admin_lvl'] == 1) {
                
                echo '<table><thead><tr><td class="notDisplayingOnPhonesTd">ID</td>
                    <td>Username</td>
                    <td>Catnip</td>
                    <td>Lvl</td>
                    <td>Ad ?</td>
                    <td class="notDisplayingOnPhonesTd">Fav Cat</td>
                    <td>Suppr</td>
                    <td>Mod</td></tr><thead>
                    <tbody>';
                
                foreach($players as $player) {
                    echo '<tr><td class="notDisplayingOnPhonesTd">' . $player['id'] . '</td>
                    <td>' . $player['username'] . '</td>
                    <td>' . $player['catnip'] . '</td>
                    <td>' . $player['lvl'] . '</td>
                    <td>' . $player['admin_lvl'] . '</td>
                    <td class="notDisplayingOnPhonesTd">' . $player['cat_id'] . '</td>
                    <td><a href="controller_admin_delete_user.php?user=' . $player['id'] . '">X</a></td>
                    <td><a href="update_user.php?user=' . $player['id'] . '">0</a></td></tr>';
                }
                
                echo '</tbody>';
            }
            
            else {
                echo '<p>This page is for admin only.</p>';
            }
        ?>
    </main>