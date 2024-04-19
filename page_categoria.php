<?php
require_once("classi/db_connection.php");
require_once("classi/prodotto.php");
require_once("classi/navbar.php");
session_start();
$db=Database::getInstance() ;
if(isset($_SESSION['id']) && $_SESSION['id']!="") {
    $navbar = new NavBar($_SESSION['id']);
} else {
    $navbar = new NavBar();
}

$id_categoria=$_GET['id'];
$index=0;

if(isset($_SESSION['id']) && $_SESSION['id']!=""){
    $id_utente=$_SESSION['id'];
    $where=array(
        "id_user"=>$id_utente, 
        "id_categoria"=>$id_categoria
    );
    $result=$db->insert("categorie_preferite", $where, "ii");
    
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
    ?>

    <div class="container">
        <h2>Prodotti</h2>
        <div class="row">
            <?php
            $where=array(
                "appartiene.idCategoria"=>$id_categoria
            );
            $result=$db->read_table("prodotto join appartiene on prodotto.ID=appartiene.idProdotto", $where, "i");
            
            while($row=$result->fetch_assoc()){
                $prodotto= new Prodotto(
                    $row['idProdotto'],
                    $row['nome'],
                    $row['descrizione'],
                    $row['prezzo'],
                    $row['quantita'],
                    $row['img_path']
                );
                echo "<div class='col'>";
                echo $prodotto->showProdHome();
                echo "</div>";
                if(($index) == 3){
                    echo "</div><div class='row'>";
                    $index = 0;
                }
                $index++;
            }
            ?>
        </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>