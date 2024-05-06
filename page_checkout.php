<?php
require_once "classi/db_connection.php";
require_once "classi/navbar.php";
$db = Database::getInstance();
session_start();
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
    $navbar->showNavbar();
    if(isset($_GET['id_carrello'])){
        $_SESSION['id_carrello']=$_GET['id_carrello'];
        
    
    ?>
    <h2>Checkout</h2>
    <form action="script/checkout.php" method="post">
        <h3>Dati di Spedizione</h3>
        
        <label for="address">Indirizzo:</label><br>
        <input type="text" id="address" name="address"><br>
        
        

        <h3>Metodo Pagamento</h3>
        <select name="Mpagamento" id="Mpagamento"></select>
        


        <input type="submit" value="Invia">
    </form>
    <?php
    } else {
        echo "Errore: manca l'ID del carrello";
    }?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            get_Mpagamento();
            
        });

        function get_Mpagamento(){
            $.ajax({
                url: "script/get_Mpagamento.php",
                type: "GET",
                success: function(data){
                    
                    
                }
            });
        }


    </script>

</body>
</html>
