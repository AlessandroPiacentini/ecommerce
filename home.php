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
    <style>
        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            z-index: 1; /* Assicura che le frecce siano posizionate sopra il carosello */
            position: absolute; /* Posizionamento assoluto rispetto al contenitore padre */
            top: 50%; /* Posiziona le frecce al centro rispetto all'altezza del contenitore padre */
            transform: translateY(-50%); /* Sposta le frecce verso l'alto di metà della loro altezza per centrarle verticalmente */
        }

        .carousel-control-prev {
            left: -30px; /* Posiziona la freccia sinistra 30px a sinistra rispetto al bordo sinistro del contenitore padre */
        }

        .carousel-control-next {
            right: -30px; /* Posiziona la freccia destra 30px a destra rispetto al bordo destro del contenitore padre */
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #000;
            height: 50px;
            width: 50px;
            border-radius: 50%;
            line-height: 50px;
            font-size: 20px;
            color: #fff;
        }

        .carousel-control-prev-icon:hover,
        .carousel-control-next-icon:hover {
            background-color: #555;
        }
    </style>
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
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                if(isset($_SESSION['id'])){
                    if($_SESSION['id'] != ""){
                        $home = new HomeGenerator($_SESSION['id']);
                    }
                    else{
                        $home = new HomeGenerator();
                    }
                }
                else{
                    $home = new HomeGenerator();
                }
                $prodotti = $home->get_prodacts();
                
                $totalProducts = count($prodotti);
                $slides = ceil($totalProducts / 4); // Calcola il numero di slide necessarie
                
                for ($i = 0; $i < $slides; $i++) {
                    echo '<div class="carousel-item';
                    if ($i == 0) echo ' active';
                    echo '">';
                    echo '<div class="row">';
                    
                    // Crea fino a 4 prodotti per slide
                    for ($j = $i * 4; $j < min(($i + 1) * 4, $totalProducts); $j++) {
                        $prodotto = $prodotti[$j];
                        $idprodotto = $prodotto['prodotto']["ID"];
                        $nome = $prodotto['prodotto']["nome"];    
                        $prezzo = $prodotto['prodotto']["prezzo"];
                        $quantita = $prodotto['prodotto']["quantita"];
                        echo '<div class="col-md-3">';
                        echo "<a href='prodotto.php?idprodotto=".$idprodotto."'><div><h5>$nome</h5>$prezzo<br>$quantita </div></a>";
                        echo '</div>';
                    }
                    
                    echo '</div>'; // Chiude la riga
                    echo '</div>'; // Chiude la slide
                }
                ?>
            </div>
        </div>
    </div>
    
    <!-- Frecce di navigazione -->
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
