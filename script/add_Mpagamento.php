<?php
require_once "../classi/db_connection.php";
session_start();
$db = Database::getInstance();

$num_card=$_POST['ccnum'];
    $exp_month=$_POST['expmonth'];
    $exp_year=$_POST['expyear'];
    $cvv=$_POST['cvv'];

if(isset($_SESSION['id']) && $_SESSION['id']!="") {
        $idutente = $_SESSION['id']; // Ottieni l'ID dell'utente dalla sessione
    } else {
        $idutente = $_COOKIE['id_utente']; // Ottieni l'ID dell'utente dai cookie

    }

    $field = ["n_carta" => $num_card, "mese_scadenza" => $exp_month, "anno_scadenza" => $exp_year, "cvv" => $cvv, "idUtente" => $idutente];
$db->insert("metodo_pagamento", $field);

header("Location: ../page_checkout.php?MP=added&id_carrello=".$_SESSION['id_carrello']);