<?php
require_once "../classi/db_connection.php";

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

$where = [ "carrello.id_utente" => $idutente];
$result = $db->read_table("ordine join carrello on ordine.idCarrello=carrello.ID", $where, "i");

$array_ordini=array();
while($row=$result->fetch_assoc()){
    array_push($array_ordini, $row);
    
}

echo json_encode($array_ordini);
