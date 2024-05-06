<?php
require_once "../classi/db_connection.php";

$db = Database::getInstance();

session_start();

if(isset($_SESSION['id_carrello']) and $_SESSION['id_carrello'] != "" ){
    $id_carrello = $_SESSION['id_carrello'];
    
    $field = ["attivo" => 0];
    $where = ["ID" => $id_carrello];
    $db->updateTable("carrello", $field, $where, "ii");

    $num_card=$_POST['ccnum'];
    $exp_month=$_POST['expmonth'];
    $exp_year=$_POST['expyear'];
    $cvv=$_POST['cvv'];


    $address=$_POST['address'];





    if(isset($_SESSION['id']) && $_SESSION['id']!="") {
        $idutente = $_SESSION['id']; // Ottieni l'ID dell'utente dalla sessione
    } else {
        $idutente = $_COOKIE['id_utente']; // Ottieni l'ID dell'utente dai cookie

    }

    $field = ["n_carta" => $num_card, "mese_scadenza" => $exp_month, "anno_scadenza" => $exp_year, "cvv" => $cvv, "idUtente" => $idutente];
    

    $db->insert("metodo_pagamento", $field);

    $result=$db->read_table("metodo_pagamento", ["idUtente"=>$idutente]);
    $row = $result->fetch_assoc();
    $id_metodo_pagamento = $row['ID'];
    $data_acquisto= date('Y-m-d');
    $field = ["idM_pagamento" => $id_metodo_pagamento, "indirizzo"=> $address, "idCarrello"=> $id_carrello, "data_acquisto"=>$data_acquisto];

    $db->insert("ordine", $field);

    header(("location: ../home.php?msg=order_success"));


}
else{
    header("Location: ../home.php");
}


?>