<?php
include("classi/genera_home.php");
require_once("classi/navbar.php");
require_once "classi/prodotto.php";

session_start();

$navbar = isset($_SESSION['id']) && $_SESSION['id'] != "" ? new NavBar($_SESSION['id']) : new NavBar();
$home = isset($_SESSION['id']) && $_SESSION['id'] != "" ? new HomeGenerator($_SESSION['id']) : new HomeGenerator();

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
    <link rel="stylesheet" href="style/style.css">

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

    <h1>Prodotti consigliati</h1>
        
    <div class='container'>
        <div class='row' id="prodotti_cons">
            <!-- Qui saranno inseriti i prodotti -->
        </div>
    </div>
    
    <button onclick="sposta(-1)">indietro</button>
    <button onclick="sposta(1)">Avanti</button>
    

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var pagina = -1;
        
        function sposta(i) {
            pagina += i;
            $.ajax({
                url: 'script/api_show_prod.php', // URL dell'API PHP
                method: 'GET',
                data: {
                    pag: pagina
                },
                success: function(data) {
                    // Inserisci l'HTML restituito nell'elemento con id 'prodotti_cons'
                    $('#prodotti_cons').html(data);
                },
                error: function(error) {
                    // Gestisci l'errore
                    console.error("Si è verificato un errore: ", error);
                }
            });
        }

        

        $(document).ready(function() {
            sposta(1);
        });
    </script>

    
</body>
</html>
