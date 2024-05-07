<?php
require_once "../classi/db_connection.php";
require_once "../classi/timer.php";
$timer = Timer::getInstance();

$db = Database::getInstance();

session_start();

if(isset($_SESSION['id_carrello']) and $_SESSION['id_carrello'] != "" ){
    $id_carrello = $_SESSION['id_carrello'];
    
    $field = ["attivo" => 0];
    $where = ["ID" => $id_carrello];
    $db->updateTable("carrello", $field, $where, "ii");

    $timer->stop();
    


    $address=$_POST['address'];





    if(isset($_SESSION['id']) && $_SESSION['id']!="") {
        $idutente = $_SESSION['id']; // Ottieni l'ID dell'utente dalla sessione
    } else {
        $idutente = $_COOKIE['id_utente']; // Ottieni l'ID dell'utente dai cookie

    }

    

    
    $id_metodo_pagamento = $_POST['Mpagamento'];
    $data_acquisto= date('Y-m-d');
    $field = ["idM_pagamento" => $id_metodo_pagamento, "indirizzo"=> $address, "idCarrello"=> $id_carrello, "data_acquisto"=>$data_acquisto];

    $db->insert("ordine", $field);

    header(("location: ../home.php?msg=order_success"));


}
else{
    header("Location: ../home.php");
}


?>