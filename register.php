<?php /* Lancement de la session et récupération données. */
    session_start();
    include('config.php');
    $identifiant=strip_tags($_POST["identifiant"]);
    $password_p=strip_tags($_POST["password_p"]);
    $mail=strip_tags($_POST["mail"]);
/* Le try catch n'aurait pas de sens dans le cadre scolaire ( Si le serveur est down, la bdd aussi ). */
/* Dans un autre contexte les deux pourraient être séparés.*/
    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (Exception $e) {
        die('Erreur : ' . $e->get . Message());
    }
/* Si $test=false ( valeur renvoyée par le formulaire d'inscription de index.php ), d'abord vérifier l'existence de l'identifiant dans la table.*/
/* Si il existe déjà, renvoi vers index.php avec un message d'erreur.*/
/* Si il n'existe pas, alors tester les données insérées par l'utilisateur.*/
    $dbh=new PDO($dsn,$user,$password);
    $req=$dbh->prepare("SELECT identifiant,mail FROM test_login WHERE identifiant=?");
    $req->execute(array($identifiant));
    if($res=$req->fetch()){
        $identifiant_recup = $res["identifiant"];
        $mail_recup = $res["mail"];
    }
    if(isset($identifiant_recup)){
        $state=3;
        $_SESSION["state"]=$state;
        header("Location: index.php");
        exit();
    }else{ /* Les champs étaient-ils vides ? Respectent-ils les règles imposées par l'expression régulière créée ? preg_match doit renvoyer vrai dans les trois cas.*/
        if ( (!empty($identifiant) || !empty($password_p) || !empty($mail)) && (preg_match($pattern_identifiant,$identifiant) && preg_match($pattern_password,$password_p) && preg_match($pattern_mail,$mail))){
            $hash_password = password_hash($password_p, PASSWORD_DEFAULT);
            $req = $dbh->prepare("INSERT INTO test_login(identifiant,password,mail) VALUES(?,?,?)");
            $req->execute(array($identifiant,$hash_password,$mail));
            $state=2;
            $_SESSION["state"] = $state;
            header("Location: index.php");
            exit();
        }else{
            $state=1;
            $_SESSION["state"] = $state;
            header("Location: index.php");
            exit();
        }
    }