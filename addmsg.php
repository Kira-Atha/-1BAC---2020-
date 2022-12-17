<?php
    session_start();
    include('config.php');
    include('library.php');

    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (Exception $e) {
        die('Erreur : ' . $e->get . Message());
    }

    if(!isset($_SESSION["mail"])){
        header('Location: index.php');
        exit();
    }else{
        $mail=$_SESSION["mail"];
    }
    if(!isset($_SESSION["identifiant"])){
        header('Location: index.php');
        exit();
    }else{
        $auteur=$_SESSION["identifiant"];
    }
    $message=strip_tags($_POST["message"]);
    if ( !empty($message) && strlen($message) <=500){
        $req = $dbh->prepare("INSERT INTO juin_msg(auteur,email,msg) VALUES(?,?,?)");
        $req->execute(array($auteur,$mail,$message));
        header("Location: content.php");
        exit();
    }else{
        $state=5;
        $_SESSION["state"]=$state;
        header('Location: content.php');
        exit();
    }