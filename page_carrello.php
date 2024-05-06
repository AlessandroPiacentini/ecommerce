<?php
// Includi il file per la connessione al database e le classi necessarie
require_once "classi/db_connection.php";
require_once "classi/prodotto.php";
require_once "classi/navbar.php";



// Ottieni un'istanza della classe per la connessione al database
$db = Database::getInstance();

// Avvia la sessione per poter utilizzare le variabili di sessione
session_start();

// Controlla se c'è un prodotto temporaneo nel carrello dell'utente
if(isset($_SESSION['prodotto_temp']) && $_SESSION['prodotto_temp'] == 1){
    echo "Hai nel carrello un prodotto che è l'ultimo, hai 5 min per acquistarlo altrimenti verrà rimosso dal carrello";
}

$result = false; // Inizializza la variabile $result come falsa

// Verifica se l'utente è loggato
if(isset($_SESSION['id']) && $_SESSION['id'] != "") {
    // Se l'utente è loggato, crea una navbar personalizzata per quell'utente
    $navbar = new NavBar($_SESSION['id']);
    // Leggi i prodotti nel carrello di quell'utente dal database
    $result = $db->read_table("(aggiunta_carrello join prodotto on aggiunta_carrello.idProdotto=prodotto.ID) join carrello on aggiunta_carrello.idCarrello = carrello.ID", array("carrello.id_utente"=>$_SESSION['id'], "attivo"=>1), "ii");
} else {
    // Se l'utente non è loggato, crea una navbar di default
    $navbar = new NavBar();
    // Verifica se ci sono cookie con l'ID dell'utente
    if(isset($_COOKIE['id_utente'])){
        // Leggi i prodotti nel carrello dell'utente dai cookie
        $result = $db->read_table("(aggiunta_carrello join prodotto on aggiunta_carrello.idProdotto=prodotto.ID) join carrello on aggiunta_carrello.idCarrello = carrello.ID", array("carrello.id_utente"=>$_COOKIE['id_utente'], "attivo"=>1), "ii");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            checkTimer();
            
        });

        function checkTimer(){
            setTimeout(function() {
                
                $.ajax({
                    url: "script/check_timer.php",
                    type: "GET",
                    success: function(data){
                        max_sec=30;
                        console.log(data);
                        if(data >= max_sec){
                            window.location.href = "script/elimina_carrello_temp.php";
                        }else{
                            if(data>=0){
                                $("#divTimer").removeAttr("hidden");
                                $("#divTimer").html("hai "+max_sec+" secondi per comprare: "+data+"/"+max_sec);
                                
                            }else{
                                $("#divTimer").attr("hidden", true);
                            }
    
                        }
                        
                    }
                });
                
                checkTimer();
                
            }, 1000); // Intervallo di tempo in millisecondi
        }

    </script>
    

</head>
<body>
    <div class='alert alert-danger' role='alert' id="divTimer" hidden></div>
    <?php
        // Mostra la navbar
        echo $navbar->showNavbar();

        if(isset($_GET['msg_timer'])){
            echo "<div class='alert alert-danger' role='alert'>".$_GET['msg_timer']."</div>";
        }

        
        $totale = 0; // Inizializza il totale
        echo "<h1>Carrello</h1>";
        echo "<div class='container'>";
        if($result){
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $id_carrello = $row['idCarrello'];
                    // Crea un oggetto Prodotto con i dati ottenuti dal database
                    $prodotto = new Prodotto(
                        $row['idProdotto'],
                        $row['nome'],
                        $row['descrizione'],
                        $row['prezzo'],
                        $row['quantita'],
                        $row['img_path']
                    );
                    // Calcola il totale considerando il prezzo del prodotto e la sua quantità nel carrello
                    $totale += ($prodotto->getPrezzo() * $row['quantita_carrello']);
                    // Mostra il prodotto nel carrello
                    echo $prodotto->showProdCarrello($row['quantita_carrello']);
                }
                // Mostra il totale del carrello e un pulsante per il checkout
                echo "<h3>Totale: $totale</h3>";
                echo "<a href='page_checkout.php?id_carrello=".$id_carrello."' class='btn btn-primary'>Checkout</a>";
                echo "</div>";
            } else {
                echo "<h3>Il carrello è vuoto</h3>";
            }
        } else {
            echo "<h3>Il carrello è vuoto</h3>";
        }
    ?>
</body>
</html>
