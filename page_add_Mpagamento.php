<?php
require_once "classi/navbar.php";

// Inizializza la sessione
session_start();

// Controlla se l'utente è loggato
if(isset($_SESSION['id']) && $_SESSION['id']!="") {
    $navbar = new NavBar($_SESSION['id']);
} else {
    $navbar = new NavBar();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php
    echo $navbar->showNavbar();
    ?>
    <form action="script/add_Mpagamento.php" method="post">
        <h3>Dati per il Pagamento</h3>
        
        <label for="ccnum">Numero della Carta di Credito:</label><br>
        <input type="text" id="ccnum" name="ccnum"><br>
        <label for="expmonth">Mese di Scadenza:</label><br>
        <input type="text" id="expmonth" name="expmonth"><br>
        <label for="expyear">Anno di scadenza:</label><br>
        <input type="text" id="expyear" name="expyear"><br>
        <label for="cvv">CVV:</label><br>
        <input type="text" id="cvv" name="cvv"><br>


        <input type="submit" value="Invia">

    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>