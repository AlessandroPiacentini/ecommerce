<?php
session_start(); // Starting the session

include("genera_home.php");
require_once("navbar.php");
require_once "prodotto.php";

if(isset($_SESSION['id']) && $_SESSION['id']!="") {
    $home = new HomeGenerator($_SESSION['id']);
} else {
    $home = new HomeGenerator();
}

// Getting the products
$prodotti = $home->get_products();

// Outputting the products
for($i = 0; $i < count($prodotti); $i++){
    
    echo $prodotti[$i]['prodotto']->showProdHome();
    
}
?>
