<?php
require_once "../classi/db_connection.php";
session_start();
$db = Database::getInstance();

if (isset($_GET['id_prodotto'])) {
    $id_prodotto = $_GET['id_prodotto'];

    if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
        $idutente = $_SESSION['id'];
    } else {
        if (isset($_COOKIE['id_utente']) && $_COOKIE['id_utente'] !== "") {
            $idutente = $_COOKIE['id_utente'];
        } else {
            header("Location: ../home.php?msg=error");
        }
    }

    $where = ["id_utente" => $idutente];
    $result = $db->read_table("carrello", $where, "i");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idCarrello = $row['ID'];
        $where = ["idProdotto" => $id_prodotto, "idCarrello" => $idCarrello];
        $result = $db->read_table("aggiunta_carrello", $where, "ii"); 

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $quantita_carrello = $row['quantita_carrello'];
            $quantita_carrello--;

            $prod_temp = $row['temporaneo'];

        
            if ($quantita_carrello == 0) {
                $where = ["idProdotto" => $id_prodotto, "idCarrello" => $idCarrello];
                $db->delete("aggiunta_carrello", $where, "ii");
                if ($prod_temp == 1) {
                    require_once "../classi/timer.php";
                    $timer = Timer::getInstance();
                    $timer->stop();
                }
            } else {
                $field = ["quantita_carrello" => $quantita_carrello];
                $where = ["idProdotto" => $id_prodotto, "idCarrello" => $idCarrello];
                $db->updateTable("aggiunta_carrello", $field, $where, "iii");
            }

            $where = ["ID" => $id_prodotto];
            $result = $db->read_table("prodotto", $where, "i");
            $row = $result->fetch_assoc();
            $quantita = $row['quantita'];
            $quantita++;
            $field = ["quantita" => $quantita];
            $where = ["ID" => $id_prodotto];
            $db->updateTable("prodotto", $field, $where, "ii");

            header("Location: ../page_carrello.php?msg=success");
        } else {
            header("Location: ../page_carrello.php?msg=error");
        }
    } else {
        header("Location: ../page_carrello.php?msg=error");
        exit();
    }
}
?>
