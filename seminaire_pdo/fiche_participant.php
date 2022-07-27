<?php
session_start();
if(!isset($_SESSION['login'])){//Si la variable session n'a pas été créee
    header("location:index.php");
    exit();
}
//Appel du fichier de connexion
require_once('../connexion_db/conn_db.php');
//Définition de la requête
$sql_soc="select * from societe";
//Exécution de la requête
$query_soc=$pdo->query($sql_soc);
//Récupération de l'id par GET
$id=$_GET['id'];
//Définition  et exécution de la requête de sélection
$sql_fiche="select * from participant where id=:id";
$query_fiche=$pdo->prepare($sql_fiche);
$query_fiche->bindParam(':id',$id,PDO::PARAM_INT);
$query_fiche->execute();
//Extraction de l'enregistrement
$fiche=$query_fiche->fetch(PDO::FETCH_ASSOC);
extract($fiche);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="../styleform.css">
</head>
<body>
<form method="post" action="modif_participant.php">
    <h2>Formulaire d'inscription</h2>
    <div class="field">
        <label>Prénoms</label>
        <input type="text" name="prenom" value="<?php echo $prenom ?>">
    </div>
    <div class="field">
        <label>NOM</label>
        <input type="text" name="nom" value="<?= $nom ?>">
    </div>
    <div class="field">
        <label>Sexe</label>
        <input type="radio" name="sexe" value="F"
        <?php if($sexe=="F") echo"checked" ?>
        >F
        <input type="radio" name="sexe" value="M"
        <?php echo ($sexe=='M')?"checked":"" ?>
        >M
    </div>
    <div class="field">
        <label>E-mail</label>
        <input type="email" name="email" value="<?= $email ?>">
    </div>
    <div class="field">
        <label>Société</label>
        <select name="id_societe">
            <option>Sélectionnez</option>
            <?php
            while($soc=$query_soc->fetch(PDO::FETCH_NUM)){
                echo"<option value='$soc[0]' ";
                echo ($id_societe==$soc[0])?"selected":"";
                echo">$soc[1]</option>";
            }
            ?>
        </select>
    </div>
    <div class="field">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input id="bouton" type="submit" name="bModif" value="Modifier">
    </div>
</form>
</body>
</html>
