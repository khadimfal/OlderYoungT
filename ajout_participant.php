<?php
//Appel du fichier de connexion
require_once('connexion_db/conn_db.php');
//Définition de la requête d'insertion
$sql_ajout="insert into participant values(null,:nom,
        :prenom,:sexe,:email,:id_societe)";
//Préparation de la requête
$rp=$pdo->prepare($sql_ajout);
//Association marqueur-valeur
$rp->bindParam(':nom',$_POST['nom'],PDO::PARAM_STR);
$rp->bindParam(':prenom',$_POST['prenom'],PDO::PARAM_STR);
$rp->bindParam(':sexe',$_POST['sexe'],PDO::PARAM_STR);
$rp->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
$rp->bindParam(':id_societe',$_POST['id_societe'],PDO::PARAM_INT);
//Exécution de la requête
if($rp->execute()){
    echo"<h2>Merci ".$_POST['nom']."! Votre inscription a bien &eacute;t&eacute; prise en compte</h2>
    <a href='form_inscription.php'>Nouvelle inscription</a>";
}
?>