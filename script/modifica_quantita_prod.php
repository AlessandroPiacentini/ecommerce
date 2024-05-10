<?php
if(isset($_GET['id']) && isset($_GET['quantita'])){
    require_once "../classi/db_connection.php";
    $db = Database::getInstance();
    $id_prodotto=$_GET['id'];
    $quantita=$_GET['quantita'];
    $where=array(
        "ID"=>$id_prodotto
    );
    $field=array(
        "quantita"=>$quantita
    );
    $db->updateTable("prodotto", $field, $where, "ii");
    header("Location: ../page_prodotto.php?id=".$id_prodotto);
}