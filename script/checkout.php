<?php
require_once "../classi/db_connection.php";

$db = Database::getInstance();

session_start();

if(isset($_GET['id_carrello']) and $_GET['id_carrello'] != "" ){
    $id_carrello = $_GET['id_carrello'];
    
    $field = ["attivo" => 0];
    $where = ["ID" => $id_carrello];
    $db->updateTable("carrello", $field, $where, "ii");

    if(isset($_SESSION['transazione']) && $_SESSION['transazione'] == 1){
        
        $db->commit();
        $_SESSION['transazione'] = 0;
    }
    echo "fatto";

}


?>