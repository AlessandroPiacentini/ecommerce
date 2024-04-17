<?php
include("genera_home.php");
require_once("navbar.php");
require_once "prodotto.php";

session_start();



if(isset($_SESSION['id']) && $_SESSION['id']!="") {
    $navbar = new NavBar($_SESSION['id']);
    $home = new HomeGenerator($_SESSION['id']);
} else {
    $navbar = new NavBar();
    $home = new HomeGenerator();
}

// Ottenimento dei prodotti
$prodotti = $home->get_products();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



</head>
<body>
    <!-- Navbar -->
    <?php echo $navbar->showNavbar(); 
    if(isset($_GET['msg'])){
        if($_GET['msg']=="error"){
            echo "<div class='alert alert-danger' role='alert'>Username o password errati</div>";
        }
        if($_GET['msg']=="added"){
            echo "<div class='alert alert-success' role='alert'>Prodotto aggiunto al carrello</div>";
        }
    }

    if(isset($_SESSION['id']) && $_SESSION['id']!="") {
        $home = new HomeGenerator($_SESSION['id']);
    } else {
        $home = new HomeGenerator();
    }



    echo "<h1>prodotti coonsigliati</h1>";
    // Getting the products
    $prodotti = $home->get_products();
    echo "<div class='container'>";

    // Outputting the products
    for($i = 0; $i < count($prodotti); $i++){
        echo "<div class='row'>";
        for($j = 0; $j < 3; $j++){
            echo "<div class='col'>";
            echo $prodotti[$i]['prodotto']->showProdHome();
            echo "</div>";
        }
        echo "</div>";
        
        
    }
    echo "</div>";
    ?>


    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
