<?php 
session_start();
require_once "../classi/db_connection.php";
$db = Database::getInstance();
if(isset($_POST['prodotto_id'])){
    $prodotto_id = $_POST['prodotto_id'];
    if(isset($_SESSION['id']) and $_SESSION['id'] != "" ){
        $idutente = $_SESSION['id'];
    }
    else{
        
        if(isset($_COOKIE['id_utente']) and $_COOKIE['id_utente'] != ""){
            $idutente = $_COOKIE['id_utente'];
        }
        else{
            $result= $db->execute_query("SELECT MAX(ID) as id FROM utente");
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $idutente = $row['id'] + 1;
            }
            setcookie("id_utente", $idutente);
            $where = ["ID" => $idutente, "isAdmin" => 0];
            $db->insert("utente", $where, "ii");

        }
        
    }

    $where = [ "id_utente" => $idutente, "attivo" => 1];
    $result = $db->read_table("carrello", $where, "ii");
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $idCarrello = $row['ID'];
    }else{
        $where = ["id_utente" => $idutente, "attivo" => 1];
        $db->insert("carrello", $where, "ii");
        $result = $db->read_table("carrello", $where, "ii");
        $row = $result->fetch_assoc();
        $idCarrello = $row['ID'];
    }

    $where = ["idProdotto" => $prodotto_id, "idCarrello" => $idCarrello];
    $result = $db->read_table("aggiunta_carrello", $where, "ii");
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $quantita = $row['quantita_carrello'];
        $quantita++;
        $field = ["quantita_carrello" => $quantita];
        $where= ["idProdotto" => $prodotto_id, "idCarrello" => $idCarrello];
        $db->updateTable("aggiunta_carrello", $field, $where, "iii");

        

    }else{
        $where = ["idProdotto" => $prodotto_id, "idCarrello" => $idCarrello, "quantita_carrello" => 1];
        $db->insert("aggiunta_carrello", $where, "iii");
    }


    $where = ["ID" => $idCarrello];
    $result = $db->read_table("prodotto", $where, "i");
    $row = $result->fetch_assoc();
    $quantita = $row['quantita'];
    $quantita--;
    $field = ["quantita" => $quantita];
    $where = ["ID" => $idCarrello];
    $db->updateTable("prodotto", $field, $where, "ii");


    header("Location: ../home.php?msg=added");
}