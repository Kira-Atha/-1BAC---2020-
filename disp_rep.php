<?php
/* Lancement de la session et récupération des valeurs.*/
    session_start();
    include('config.php');
    include('library.php');

    if (!isset($_SESSION["state"])) {
        $state = 0;
    } else {
        $state = $_SESSION["state"];
    }
    if (!isset($_SESSION["mail"])) {
        header('Location: index.php');
        exit();
    } else {
        $mail = $_SESSION["mail"];
    }
    if (!isset($_SESSION["identifiant"])) {
        header('Location: index.php');
        exit();
    }else {
        $auteur = $_SESSION["identifiant"];
    }
    if (!isset($_SESSION["login"])) {
        header('Location: index.php');
        exit();
    }else {
        $login = $_SESSION["login"];
    }
    if(!isset($_POST["mid"])){
        $mid=$_SESSION["mid"];
    }else {
        $mid = $_POST["mid"];
    }
    ?><!doctype html>
<html lang="FR">
<head>
    <meta name="author" content="HUYGEBAERT Amandine">
    <link rel="stylesheet" href="style.css">
    <script src="common.js"></script>
    <script src="script.js"></script>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="42.png" />
    <meta charset="UTF-8">
    <title>Réponses à un message</title>
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
        <legend class="legend">Message</legend>
           <?php  /* Affichage le message en question */
                $dbh = new PDO($dsn, $user, $password);
                $req = $dbh->prepare("SELECT mid,auteur, email, msg,ts FROM juin_msg WHERE mid=? ");
                $req->execute(array($mid));
                while ($res = $req->fetch()) {
                    echo '<table>';
                            echo '<tr>';
                            echo '<th>Auteur: ' . $res["auteur"] . '(' . $res["email"] . ')</th>';
                            echo '</tr> <th>Message</th>';
                            echo '<td class="msg">' . $res["msg"] . '</td>';
                            echo '</tr>';
                    echo '</table>';
                } ?>
            <div id="answer">
                <?php  /* Affichage des réponses en fonction du message. */
                $dbh = new PDO($dsn, $user, $password);
                $req = $dbh->prepare("SELECT aid,mid,auteur,email, ans,ts,p1,m1 FROM juin_answer WHERE mid=? ORDER BY aid");
                $req->execute(array($mid));
/* Deux formulaires pour gérer le + et le - */
                while ($res = $req->fetch()) {
                    echo "Réponse";
                    echo '<table>';
                        echo '<tr><th>Auteur: ' . $res["auteur"] . '(' . $res["email"] . ')</th></tr>';
                        echo '<tr><th>Message</th><td class="msg">' . $res["ans"] . '</td></tr>';
                        echo '<tr><td>'.$res["p1"].'
                        <form action="plus.php" method="post">
                            <input type="hidden" name="aid" value='.$res["aid"].'>
                            <input type="submit" class="button" value="(+1)">
                        </form>';
                         echo $res["m1"].'
                             <form action="moins.php" method="post"> 
                                <input type="hidden" name="aid" value='.$res["aid"].'>
                                <input type="submit" class="button" value="(-1)"></tr></td>';
                         echo '</form>';
                    echo '</table>';
                }?>
            </div>
        </fieldset>
    </div>
    <div id="add_msg">
        <fieldset>
            <legend class="legend">Répondre à ce message</legend>
            <?php if($state==6){
                echo '<p class="error" id="error">Votre répondre est trop longue (500 caractères max) ou est vide</p>';
            }?>
            <form method="post" action="ansmsg.php">
                <?php
                $_SESSION["mid"]=$mid;
                $_SESSION["identifiant"]=$auteur;
                $_SESSION["mail"]=$mail;
                ?>
                <textarea rows="20" cols="50" maxlength="500" name="ansmessage"></textarea>
                <input type="submit" value="envoyer" class="button">
            </form>
        </fieldset>
    </div>
    <?php dis_footer(); ?>
</div>
</body>
</html>