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
    if(!isset($_SESSION["mid"])){
        header('Location: disp_rep.php');
    }else{
        $mid=$_SESSION["mid"];
    }
    $ansmessage=strip_tags($_POST["ansmessage"]);
    if ( ($ansmessage) && ( strlen($ansmessage)<=500) && is_numeric($mid)){
        $req = $dbh->prepare("INSERT INTO juin_answer(mid,auteur,email,ans) VALUES(?,?,?,?)");
        $req->execute(array($mid,$auteur,$mail,$ansmessage));
        $_SESSION["mid"] = $mid;
        header('Location: disp_rep.php');
        exit();
    }else{
        $_SESSION["state"]=6;
        header('Location: disp_rep.php');
        exit();
    }