<?php
require_once "../classi/db_connection.php";
require_once "../classi/timer.php";
session_start();
$db = Database::getInstance();
$timer = Timer::getInstance();

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

$where = [ "id_utente" => $idutente, "attivo" => 1];
$result = $db->read_table("carrello", $where, "ii");
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $idCarrello = $row['ID'];
    $where = ["idCarrello" => $idCarrello, "temporaneo"=>1];
    $result=$db->read_table("aggiunta_carrello", $where, "ii");

    while($row=$result->fetch_assoc()){
        $fatto=false;

        $id_prodotto= $row['idProdotto'];
        $quantita_carrello=$row['quantita_carrello'];
        $quantita_carrello--;

        if($quantita_carrello == 0){
            fwrite($f, "quantita_carrello == 0 entra\n");
            $where = ["idProdotto" => $id_prodotto, "idCarrello" => $idCarrello];
            $db->delete("aggiunta_carrello", $where, "ii");
            $fatto=true;
            
        }else{
            $field = ["quantita_carrello" => $quantita_carrello];
            $where= ["idProdotto" => $id_prodotto, "idCarrello" => $idCarrello];
            $db->updateTable("aggiunta_carrello", $field, $where, "iii");
            $fatto=true;
        }
        if($fatto){
            $where = ["ID" => $id_prodotto];
            $result = $db->read_table("prodotto", $where, "i");
            $row = $result->fetch_assoc();
            $quantita = $row['quantita'];
            $quantita++;
            $field = ["quantita" => $quantita];
            $where = ["ID" => $id_prodotto];
            $db->updateTable("prodotto", $field, $where, "ii");
            $timer->stop();
            
            header("Location: ../page_carrello.php?msg_timer=eliminati i prodotti perchè passato troppo tempo");
        }
    }


}

?>