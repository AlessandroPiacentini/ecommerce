<?php
require_once "classi/db_connection.php"

$db = Database::getInstance();

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

$where = [ "id_utente" => $idutente];
$result = $db->read_table("metodo_pagamento", $where, "i");
$array_MP=array();
while($row=$result->fetch_assoc()){
    array_push($array_MP, $row);
}
?>