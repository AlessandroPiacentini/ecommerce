<?php
// Avvia la sessione
session_start();

// Includi il file per generare la home e la classe Prodotto
include("../classi/genera_home.php");
require_once "../classi/prodotto.php";

// Verifica se l'utente è loggato e imposta l'oggetto HomeGenerator di conseguenza
if(isset($_SESSION['id']) && $_SESSION['id']!="") {
    $home = new HomeGenerator($_SESSION['id']);
} else {
    $home = new HomeGenerator();
}

// Ottieni i prodotti
$prodotti = $home->get_products();

// Verifica se è impostata la pagina
if(isset($_GET['pag'])){
    $pag = $_GET['pag'] * 5;
    // Verifica se la pagina è inferiore a 0 o superiore al numero di prodotti
    if($pag < 0){
        $pag = count($prodotti) +  $pag % count($prodotti);
    }
    if($pag >= count($prodotti)){
        $pag = $pag % count($prodotti);
    }
} else {
    $pag = 0;
}

$output = "";

// Output dei prodotti
for($i = $pag; $i < ($pag + 5); $i++){
    if($i >= count($prodotti)){
        break;
    }
    $output .= $prodotti[$i]['prodotto']->showProdHome();
}

// Stampare l'output
echo $output;
?>
