<?php
//Appel du fichier de connexion
require_once('connexion_db/conn_db.php');
//Définition de la requête
$sql_soc="select * from societe";
//Exécution de la requête
$query_soc=$pdo->query($sql_soc);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleform.css">
</head>
<body>
    <?php include "menu.php"; ?>
<form method="post" action="ajout_participant.php">
    <h2>Formulaire inscription</h2>
    <div class="field">
        <label>Prénoms</label>
        <input type="text" name="prenom">
    </div>
    <div class="field">
        <label>NOM</label>
        <input type="text" name="nom">
    </div>
    <div class="field">
        <label>Sexe</label>
        <input type="radio" name="sexe" value="F">F
        <input type="radio" name="sexe" value="M">M
    </div>
    <div class="field">
        <label>E-mail</label>
        <input type="email" name="email">
    </div>
    <div class="field">
        <label>Société</label>
        <select name="id_societe">
            <option>Sélectionnez</option>
            <?php
            //exploitation des données
            while($soc=$query_soc->fetch(PDO::FETCH_NUM)){
                echo"<option value='$soc[0]'>$soc[1]</option>";
            }
            ?>
        </select>
    </div>
    <div>
        <input id="bouton" type="submit" name="bInscrire" value="S'inscrire">
    </div>
</form>
</body>
</html>
