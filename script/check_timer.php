<?php
require_once "../classi/timer.php";
session_start();
if(isset($_SESSION['id']) and $_SESSION['id'] != "" ){
    $idutente = $_SESSION['id'];
    
}
else{
    
    if(isset($_COOKIE['id_utente']) and $_COOKIE['id_utente'] != ""){
        $idutente = $_COOKIE['id_utente'];
    }
    else{
        header("Location: ../home.php?msg=error");
    }
    
}

$timer =new Timer($idutente);


echo $timer->getSecond();