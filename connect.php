<?php
    
try {

    $pdo = new PDO(
            'mysql:host=home.3wa.io:3307;dbname=live-33_yoanl_nekonyan',
            'yoanl',
            '7b184572NDBkMDQ0Y2Y3MmYyMWE0MTJiYWVhOWExf61b475d',// ici le mot de passe
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    $pdo->exec('set names utf8');
} catch (PDOexception $error ) {
    var_dump($error->getMessage());
}


$queryCats = "
    SELECT id, name, show_min, show_max, image, catnip, min_require, price
    FROM neko";
$statement = $pdo->prepare($queryCats);
$statement->execute();
$nekos = $statement->fetchAll(PDO::FETCH_ASSOC);

if(!isset($_SESSION)) {
    session_start();
}

$_SESSION['nekos'] = $nekos;