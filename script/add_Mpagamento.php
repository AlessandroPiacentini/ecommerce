<?php
// Richiedi il file di connessione al database
require_once "../classi/db_connection.php";
// Avvia la sessione
session_start();

// Ottieni un'istanza del database
$db = Database::getInstance();

// Ottieni i dati inviati dal modulo
$num_card = $_POST['ccnum'];
$exp_month = $_POST['expmonth'];
$exp_year = $_POST['expyear'];
$cvv = $_POST['cvv'];

// Verifica se l'ID dell'utente è impostato nella sessione
if(isset($_SESSION['id']) && $_SESSION['id']!="") {
    $idutente = $_SESSION['id']; // Ottieni l'ID dell'utente dalla sessione
} else {
    $idutente = $_COOKIE['id_utente']; // Ottieni l'ID dell'utente dai cookie
}

// Campi da inserire nel database
$field = ["n_carta" => $num_card, "mese_scadenza" => $exp_month, "anno_scadenza" => $exp_year, "cvv" => $cvv, "idUtente" => $idutente];

// Esegui l'inserimento dei dati nel database
$db->insert("metodo_pagamento", $field);

// Reindirizza alla pagina di checkout con un messaggio di conferma
header("Location: ../page_checkout.php?MP=added&id_carrello=".$_SESSION['id_carrello']);
?>
