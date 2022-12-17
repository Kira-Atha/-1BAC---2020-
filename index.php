<?php
/* Lancement de la session et récupération des variables qu'elles contiennent, si elles existent. Si pas, valeur par défaut.*/
    session_start();
    if(!isset($_SESSION["state"])){
        $state=0;
    }else{
        $state=$_SESSION["state"];
    }
    if(!isset($_SESSION["login"])){
        $login=0;
    }else{
        $login=$_SESSION["login"];
    }
    include("config.php");
    include("library.php");
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
        <title>Home</title>
    </head>
    <body>
        <div class="content" id="content">
        <?php
            dis_header();
            dis_menu($login);
/* Forcer le retour sur la première page aperçue lors de la connexion lorsque l'utilisateur s'est connecté.*/
            if($login==1){
                header("Location: content.php");
                exit();
            }?>
        <div id="login">
                <fieldset>
                    <legend class="legend">Login</legend>
                    <form method="post" action="login.php">
                        <p>Identifiant : <input type="text" name="identifiant" id="identifiant"></p>
                        <p>Password : <input type="password" name="password_p" id="password_p">
                        <input type="submit" value="connexion" id="button_login"></p>
                        <button type="button" id="button_register">S'inscrire</button>
                    </form>
                </fieldset>
            </div>
            <div id="register">
                <fieldset>
                    <legend class="legend">Register</legend>
                    <form method="post" action="register.php">
                        <p>Identifiant : <input type="text" name="identifiant"></p>
                        <p>Password : <input type="password" name="password_p"></p>
                        <p>E-mail : <input type="text" name="mail">
                            <input type="submit" value="S'inscrire" class="button"></p>
                    </form>
                </fieldset>
                <div id="info_register">
                    <?php echo $info_pattern; ?>
                </div>
            </div>
            <?php /* Génération du message d'erreur en fonction de l'état rencontré.*/
            echo '<p class="error" id="error">';
                if($state==1){
                    echo "Votre identifiant ou votre mot de passe ou votre e-mail ne respecte les règles mentionnées sur la page d'inscription.";
                }elseif($state==2){
                    echo "Votre compte a bien été créé. Veuillez vous connecter.";
                }elseif($state==3){
                    echo "Ce nom d'utilisateur existe déjà.";
                }elseif($state==4){
                    echo "Votre nom d'utilisateur ou mot de passe n'existe pas.";
                }elseif($state==-1){
                    echo "Vous êtes bien déconnecté. À la prochaine ! ";
                }
            echo '</p>';
            dis_footer();
            ?>
        </div>
    </body>
</html>