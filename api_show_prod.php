<?php
session_start(); // Starting the session

include("genera_home.php");
require_once "prodotto.php";

if(isset($_SESSION['id']) && $_SESSION['id']!="") {
    $home = new HomeGenerator($_SESSION['id']);
} else {
    $home = new HomeGenerator();
}

$prodotti = $home->get_products();

if(isset($_GET['pag'])){
    $pag = $_GET['pag'] * 5;
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

// Outputting the products
for($i = $pag; $i < ($pag + 5); $i++){
    if($i >= count($prodotti)){
        break;
    }
    $output .= $prodotti[$i]['prodotto']->showProdHome();
}

echo $output;
?>
