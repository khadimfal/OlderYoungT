<?php
session_start();
if(!isset($_SESSION['login'])){//Si la variable session n'a pas été créee
    header("location:index.php");
    exit();
}
//Appel du fichier de connexion à la bd
require_once('../connexion_db/conn_db.php');
//Définition de la requête de sélection
$sql_part="select * from participant natural join societe";
//Exécution
$query_part=$pdo->query($sql_part);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des participants</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../styletable.css">
</head>
<body>
    <?php include"menu.php" ?>
<table>
    <caption>Liste des participants</caption>
    <tr>
        <th>Modification</th>
        <th>Suppression</th>
        <th>NOM</th>
        <th>Prénoms</th>
        <th>E-mail</th>
        <th>Sexe</th>
        <th>Société</th>
    </tr>
    <?php
    while($part=$query_part->fetch(PDO::FETCH_ASSOC)){//Tant qu'on extrait des lignes sous forme de tableau associatif
        extract($part);
        echo"<tr>
                <td><a href='fiche_participant.php?id=$id'>Editer</a></td>
                <td><a href='supprim_participant.php?id=$id'
                    onclick=\"return confirm('Voulez vous supprimer $nom ? Oui ou Non?');\">Supprimer</a></td>
                <td>$nom</td>
                <td>$prenom</td>
                <td>$email</td>
                <td>$sexe</td>
                <td>$nom_societe</td>
            </tr>";
    }
    ?>
</table>


</body>
</html>
