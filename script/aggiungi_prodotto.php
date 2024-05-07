<?php
session_start();
include "../classi/db_connection.php";
$db= Database::getInstance();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descrizione = $_POST['descrizione'];
    $prezzo = $_POST['prezzo'];
    $quantita = $_POST['quantita'];

    // Gestione del file caricato
    $img_path = $_FILES['img_path']['tmp_name'];
    $img_name = $_FILES['img_path']['name'];
    $target_dir = "../img/";
    $target_file = $target_dir . basename($img_name);

    // Sposta il file caricato nella cartella di destinazione
    if (move_uploaded_file($img_path, $target_file)) {
        $where = array(
            "nome" => $nome,
            "descrizione" => $descrizione,
            "prezzo" => $prezzo,
            "quantita" => $quantita,
            "img_path" => $target_file
        );

        $db->insert("prodotto", $where);

        header("Location: ../home.php?load-prod=success");

    }else{
        header("Location: ../home.php?load-prod=error");
    }

}
?>
