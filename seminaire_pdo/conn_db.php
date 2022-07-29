<?php
//Connexion et sélection de la source de données
$login = 'userseminaire';
$pwd = 'passer';
$dsn = 'mysql:host=oldyoungdb;dbname=seminaire_db';
try {
    $pdo = new PDO($dsn, $login, $pwd);
}
catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage() );
}
?>