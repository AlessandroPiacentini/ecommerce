<?php
require_once "classi/db_connection.php";
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
<html>
<head>
    <title>Pagina di Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php
    // Mostra la barra di navigazione
    echo $navbar->showNavbar();

    // Controlla se è stato passato l'ID del carrello
    if(isset($_GET['id_carrello'])){
        $_SESSION['id_carrello'] = $_GET['id_carrello'];
    ?>
    <div class="container">
        <h2>Checkout</h2>
        <form action="script/checkout.php" method="post">
            <h3>Dati di Spedizione</h3>
            <div class="form-group">
                <label for="address">Indirizzo:</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>

            <h3>Metodo di Pagamento</h3>
            <div class="form-group">
                <select class="form-control" name="Mpagamento" id="Mpagamento"></select>
            </div>

            <button type="submit" class="btn btn-primary">Invia</button>
        </form>
        <br>
        <a href="page_add_Mpagamento.php" class="btn btn-secondary">aggiungi metodo di pagamento</a>
    </div>

    <?php
    } else {
        echo "<div class='container'>Errore: manca l'ID del carrello</div>";
    }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            get_Mpagamento();
        });

        function get_Mpagamento(){
            $.ajax({
                url: "script/get_Mpagamento.php",
                type: "GET",
                dataType: "json", 
                success: function(data){
                    // Controlla la lunghezza dei dati
                    if(data.length > 0){
                        for(let i = 0; i < data.length; i++){
                            $("#Mpagamento").append("<option value='" + data[i]['ID'] + "'>" + data[i]['n_carta'] + "</option>");
                        }
                    } else {
                        // Se non ci sono dati, mostra un messaggio di errore
                        $("#Mpagamento").append("<option>Nessun metodo di pagamento disponibile</option>");
                    }
                }
            });
        }
    </script>

</body>
</html>
