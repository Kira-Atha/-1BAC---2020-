<?php /* Lancement de la session et récupération données. */
    session_start();
    include('config.php');
    $identifiant=strip_tags($_POST["identifiant"]);
    $password_p=strip_tags($_POST["password_p"]);
/* Le try catch n'aurait pas de sens dans le cadre scolaire ( Si le serveur est down, la bdd aussi ). */
/* Dans un autre contexte les deux pourraient être séparés.*/
    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (Exception $e) {
        die('Erreur : ' . $e->get . Message());
    }
/* Vérifier si l'identifiant, le password et le mail existent bien dans la BDD lorsque l'identifiant est celui entré.*/
/*  Stocker les résultats dans des variables pour les réutiliser par après.*/
    $hash_password = password_hash($password_p, PASSWORD_DEFAULT);
    $dbh=new PDO($dsn,$user,$password);
    $req=$dbh->prepare("SELECT identifiant, password, mail FROM test_login WHERE identifiant=?");
    $req->execute(array($identifiant));
    while($res=$req->fetch()){
        $identifiant_recup=$res["identifiant"];
        $password_recup=$res["password"];
        $mail_recup=$res["mail"];
    }
/* Comparaison du mot de passe hashé (selon les normes sha256) qui se trouve dans la table avec celui qui a été récupéré et hashé.*/
/* password_verify doit renvoyer vrai pour permettre la connexion et ainsi l'accès au contenu nécessitant connexion.*/
    if(password_verify($password_p,$password_recup)){
        $login = 1;
        $_SESSION["login"]=$login;
        $_SESSION["mail"]=$mail_recup;
        $_SESSION["identifiant"]=$identifiant_recup;
        header("Location: content.php");
        exit();
    }else{
        $state=4;
        $_SESSION["state"] = $state;
        header("Location: index.php");
        exit();
    }