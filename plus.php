<?php
/* Récupération des valeurs nécessaires + lancer sessions. */
    session_start();
    include('config.php');
    include('library.php');

    if(!isset($_POST["aid"])){
        header('Location: disp_rep.php');
    }else {
        $aid = $_POST["aid"];
    }
    if(!isset($_SESSION["mid"])){
        header('Location: disp_rep.php');
    }else{
        $mid=$_SESSION["mid"];
    }
    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (Exception $e) {
        die('Erreur : ' . $e->get . Message());
    }
/* D'abord récupérer p1 de la table et le modifier */
    $dbh = new PDO($dsn, $user, $password);
    $req = $dbh->prepare("SELECT p1 FROM juin_answer WHERE aid=? ");
    $req->execute(array($aid));
    if($res=$req->fetch()){
        $p1=$res["p1"]+1;
    }
    $req2=$dbh->prepare("UPDATE juin_answer SET p1=? WHERE aid=?");
    $req2->execute(array($p1,$aid));
    $_SESSION["mid"]=$mid;

    header('Location: disp_rep.php');