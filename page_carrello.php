<?php
require_once "classi/db_connection.php";

require_once "classi/prodotto.php";
require_once "classi/navbar.php";
$db = Database::getInstance();
session_start();

if(isset($_SESSION['trasanzione']) && $_SESSION['trasanzione']==1){
    echo $_SESSION['trasanzione'];
}



$result=false;
if(isset($_SESSION['id']) && $_SESSION['id']!="") {
    $navbar = new NavBar($_SESSION['id']);
    $result=$db->read_table("(aggiunta_carrello join prodotto on aggiunta_carrello.idProdotto=prodotto.ID) join carrello on aggiunta_carrello.idCarrello = carrello.ID", array("carrello.id_utente"=>$_SESSION['id'], "attivo"=>1), "ii");

} else {
    $navbar = new NavBar();
    if(isset($_COOKIE['id_utente'])){
        
        $result=$db->read_table("(aggiunta_carrello join prodotto on aggiunta_carrello.idProdotto=prodotto.ID) join carrello on aggiunta_carrello.idCarrello = carrello.ID", array("carrello.id_utente"=>$_COOKIE['id_utente'], "attivo"=>1), "ii");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>
    <?php


        echo $navbar->showNavbar();

        $totale=0;
        echo "<h1>Carrello</h1>";
        echo "<div class='container'>";
        if($result){
            if($result->num_rows>0){
                    
                while($row=$result->fetch_assoc()){
                    $id_carrello = $row['idCarrello'];
                    $prodotto= new Prodotto(
                        $row['idProdotto'],
                        $row['nome'],
                        $row['descrizione'],
                        $row['prezzo'],
                        $row['quantita'],
                        $row['img_path']
                    );
                    $totale+=($prodotto->getPrezzo()*$row['quantita_carrello']);
                    echo $prodotto->showProdCarrello($row['quantita_carrello']);
                }
                echo "<h3>Totale: $totale</h3>";
                echo "<a href='checkout.php?id_carrello=".$id_carrello."' class='btn btn-primary'>Checkout</a>";
                echo "</div>";
            }
            else{
                echo "<h3>Il carrello è vuoto</h3>";
            }
        }
        else{
            echo "<h3>Il carrello è vuoto</h3>";
        }
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>