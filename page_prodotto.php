<?php
require_once("navbar.php");
require_once "prodotto.php";
require_once "db_connection.php";

session_start();
$db=Database::getInstance() ;
// Inizializzazione degli oggetti HomeGenerator e NavBar in base alla sessione
if(isset($_SESSION['id']) && $_SESSION['id'] != "") {
    $navbar = NavBar::getInstance($_SESSION['id']);
} else {
    $navbar = NavBar::getInstance();
}
$id_prodotto=$_GET['id'];
$where=array(
    "ID"=>$id_prodotto
);

$result=$db->read_table("prodotto", $where, "i");
$row=$result->fetch_assoc();

$prodotto= new Prodotto(
    $row['ID'],
    $row['nome'],
    $row['descrizione'],
    $row['data_aggiunta'],
    $row['prezzo'],
    $row['quantita'],
    $row['img_path']
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Personalizzazione stili */
        .product-img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php
        echo $navbar->showNavbar();
        echo $prodotto->showProdPage();
    ?>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>