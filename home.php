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
</head>
<body>
    <!-- Navbar -->
    <?php echo $navbar->showNavbar(); ?>

    <!-- Prodotti Consigliati -->
    <div class="container">
        <h2>Prodotti Consigliati</h2>
        <div class="row">
            <?php foreach ($prodotti as $index => $prodotto): ?>
                <div class="col">
                    <?php echo $prodotto['prodotto']->showProdHome(); ?>
                </div>
                <?php if(($index + 1) % 3 == 0): ?>
                    </div><div class="row">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
