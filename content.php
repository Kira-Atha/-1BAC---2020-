<?php
/* Lancement de la session et récupération des valeurs.*/
    session_start();
    include('config.php');
    include('library.php');
    if(!isset($_SESSION["state"])){
        $state=0;
    }else{
        $state=$_SESSION["state"];
    }
    if(!isset($_SESSION["mail"])){
        header('Location: index.php');
        exit();
    }else{
        $mail=$_SESSION["mail"];
    }
    if(!isset($_SESSION["identifiant"])) {
        header('Location: index.php');
        exit();
    }else{
        $auteur = $_SESSION["identifiant"];
    }
    if(!isset($_SESSION["login"])||$_SESSION["login"]==0){
        header('Location: index.php');
        exit();
    }else{
        $login=$_SESSION["login"];
    }
?>
<!doctype html>
<html lang="FR">
<head>
    <meta name="author" content="HUYGEBAERT Amandine">
    <link rel="stylesheet" href="style.css">
    <script src="common.js"></script>
    <script src="script.js"></script>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="42.png" />
    <meta charset="UTF-8">
    <title>Messages postés</title>
</head>
<body>
<div class="content" id="content">
<?php
    dis_header();
    dis_menu($login);
    /*  Si l'utilisateur n'est pas connecté ou essaie de lancer la page content avec le tunnel content.php, il sera automatiquement renvoyé à la page de connexion.*/
    ?>
    <div id="content_msg">
        <fieldset>
        <legend class="legend">Derniers messages ajoutés</legend>
        <p><div class="hello">
                <?php echo "Bonjour ".$mail; ?>
            </div>
        </p>
           <?php  /* Affichage des messages par ordre de mid. */
                $dbh = new PDO($dsn, $user, $password);
                $req = $dbh->prepare("SELECT mid,auteur, email, msg,ts FROM juin_msg ORDER BY mid ");
                $req->execute();
                while ($res = $req->fetch()) {
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Auteur: ' . $res["auteur"] . '(' . $res["email"] . ')</th>';
                    echo '</tr> <th>Message</th>';
                    echo '<td class="msg">' . $res["msg"] . '</td>';
                    echo '</tr>';
                    $req2=$dbh->prepare("SELECT COUNT (*) as aid FROM juin_answer WHERE mid=?");
                    $req2->execute(array($res["mid"]));
                    while($res2=$req2->fetch()){
                        $count_rep=$res2[0];
                    }
                    $mid=$res["mid"];
                    echo '<form action="disp_rep.php" method="post">';
                        echo '<input type="hidden" name="mid" value='.$mid.'>';
                        echo '<th><input type="submit" value="Répondre" class="button"> Réponses : '.$count_rep.'</th>';
                    echo '</form>';
                    echo '</table>';
                    echo '<br>';
                } ?>
        </fieldset>
    </div>
    <div id="add_msg">
        <fieldset>
            <legend class="legend">Ajouter un nouveau message</legend>
            <?php if($state==5){
                echo '<p class="error" id="error">Votre message est trop long (500 caractères max) ou est vide</p>';
            }?>
            <form method="post" action="addmsg.php">
                <textarea rows="20" cols="50" maxlength="500" name="message"></textarea>
                <input type="submit" value="envoyer" class="button">
            </form>
        </fieldset>
    </div>
    <?php dis_footer(); ?>
</div>
</body>
</html>