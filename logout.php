<?php
    session_start();
    if(!isset($_SESSION["state"])){
        $state=0;
    }else{
    $state=$_SESSION["state"];
    }
    $_SESSION["state"]=-1;
    $_SESSION["login"]=0;
    header("Location: index.php");
    exit();