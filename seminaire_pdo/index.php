<?php
session_start();//Démarrer ou relancer la session
if(isset($_SESSION['login'])){//Si on est déjà authentifié
    header("location:liste_participants.php");
    exit();
}
if(isset($_POST['Bconnexion'])){//SI on clique sur le bouton connexion
    //Appel du fichier de connexion à la bd
    require_once('../connexion_db/conn_db.php');
    //Récupération des données par la méthode POST
    $login=$_POST['login'];
    $mdp=$_POST['mdp'];
    $mdpHash=sha1($mdp);
    //Définition de la requête de selection
    $sql_auth="select count(*) nbl from admin where login=:login and mdp=:mdpHash";
    $query_auth=$pdo->prepare($sql_auth);
    $query_auth->bindParam(':login',$login,PDO::PARAM_STR);
    $query_auth->bindParam(':mdpHash',$mdpHash,PDO::PARAM_STR);
    if($query_auth->execute()){
        $auth=$query_auth->fetch(PDO::FETCH_OBJ);
        if($auth->nbl==1){//Si l'authentification est correcte
            $_SESSION['login']=$login;//Initialisation de la variable session
            header("location:liste_participants.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Authentification</title>
    <link rel="stylesheet" href="../styleform.css">
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
<h2>Authentification</h2>
<div class="field">
    <label>Login</label>
    <input type="text" name="login">
</div>
<div class="field">
    <label>Mot de passe</label>
    <input type="password" name="mdp">
</div>
<div class="field">
    <input id="bouton" type="submit" name="Bconnexion" value="Connexion">
</div>
</form>

</body>
</html>