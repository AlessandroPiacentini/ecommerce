<?php
include("genera_home.php");
session_start();
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="home.php">Il mio sito</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="categorie.php">Categories</a>
                </li>
                <li class="nav-item">
                    <?php
                    if((isset($_SESSION['username'])) ){
                        if($_SESSION['username']!=""){
                            echo "<a class='nav-link' href='profilo.php'>Profile</a>";
                        }
                        else{
                            echo "<a class='nav-link' href='login.php'>You are not logged in  </a>";
                        } 
                    }
                    else{
                        echo "<a class='nav-link' href='login.php'>You are not logged in  </a>";
                    } 
                    ?>
                </li>
                <?php
                if((isset($_SESSION['username']))) {
                    if($_SESSION['username']!=""){
                        echo "<li  class='nav-item'>";
                        echo "<a class='nav-link' href='logout.php'>Log out</a> ";
                        echo "</li>";
                    }
                }
                ?>
            </ul>
        </div>
    </nav>
    
    <div class="container mt-4">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                $home = new HomeGenerator($_SESSION['id']);
                $prodotti = $home->get_prodacts();
                if (!empty($prodotti)) {
                    foreach($prodotti as $key => $prodotto){
                        $idprodotto = $prodotto['prodotto']["ID"];
                        $nome = $prodotto['prodotto']["nome"];    
                        $prezzo = $prodotto['prodotto']["prezzo"];
                        $quantita = $prodotto['prodotto']["quantita"];
                        echo '<div class="carousel-item';
                        if ($key == 0) echo ' active';
                        echo '">';
                        echo "<a href='prodotto.php?idprodotto=".$idprodotto."'><div><h5>$nome</h5>$prezzo<br>$quantita </div></a>";
                        echo '</div>';
                    }
                } else {
                    echo '<div class="carousel-item active">';
                    echo "<p>No products available</p>";
                    echo '</div>';
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
