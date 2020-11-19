<?php
    require('connect.php');
    
    $_SESSION['catnip'] = $_GET['key'];
    $userCatnip = $_SESSION['catnip'];
    
    header('Content-Type: Application/json');

    echo json_encode($userCatnip);  