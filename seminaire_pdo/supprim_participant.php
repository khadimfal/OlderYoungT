<?php
session_start();
if(!isset($_SESSION['login'])){//Si la variable session n'a pas été créee
    header("location:index.php");
    exit();
}
//Appel du fichier de connexion à la bd
require_once('../connexion_db/conn_db.php');
//Récupération de l'id par la méthode GET
$id=$_GET['id'];
//Définition de la requête de suppression
$sql_supprim="delete from participant where id=:id";
//Préparation de la requête
$rp=$pdo->prepare($sql_supprim);
$rp->bindParam(':id',$id,PDO::PARAM_INT);
//Exécution de la requête
if($rp->execute()){
    //Redirection
    header("location:liste_participants.php");
}
?>