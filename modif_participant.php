<?php
session_start();
if(!isset($_SESSION['login'])){//Si la variable session n'a pas été créee
    header("location:index.php");
    exit();
}
//Appel du fichier de connexion
require_once('../connexion_db/conn_db.php');
//Définition de la requête de modification
$sql_update="update participant set nom=:nom, prenom=:prenom,
            sexe=:sexe,email=:email, id_societe=:id_societe
            where id=:id";
//Préparation de la requête
$rp=$pdo->prepare($sql_update);
//Association marqueur-valeur
$rp->bindParam(':nom',$_POST['nom'],PDO::PARAM_STR);
$rp->bindParam(':prenom',$_POST['prenom'],PDO::PARAM_STR);
$rp->bindParam(':sexe',$_POST['sexe'],PDO::PARAM_STR);
$rp->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
$rp->bindParam(':id_societe',$_POST['id_societe'],PDO::PARAM_INT);
$rp->bindParam(':id',$_POST['id'],PDO::PARAM_INT);
//Exécution de la requête
if($rp->execute()){
    header("location:liste_participants.php");
    exit();
}
?>
