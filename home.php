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


    <script>
        $.ajax({
            url: "api_show_prod.php",
            type: "GET",
            data: {pag: 0},
            success: function(data){
                $("#prodotti").html(data);
                pag;
            }
        }); 
    </script>


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

        
    ?>

    <!-- Prodotti Consigliati -->
    <div class="container">
        <h2>Prodotti Consigliati</h2>
        
    </div>





    <div id="mioCarosello" class="carousel slide" data-ride="carousel">
        <!-- Indicatori -->
        <ol class="carousel-indicators">
            <li data-target="#mioCarosello" data-slide-to="0" class="active"></li>
            <li data-target="#mioCarosello" data-slide-to="1"></li>
            <li data-target="#mioCarosello" data-slide-to="2"></li>
        </ol>

        <!-- Slides -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                
            </div>
            <div class="carousel-item">
                prova
            </div>
            <div class="carousel-item">
                hi
            </div>
        </div>

        <!-- Controlli -->
        <a class="carousel-control-prev" href="#mioCarosello" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Precedente</span>
        </a>
        <a class="carousel-control-next" href="#mioCarosello" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Successivo</span>
        </a>
    </div>


    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
