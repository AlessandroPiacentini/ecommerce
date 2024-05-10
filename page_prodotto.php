<?php
require_once("classi/navbar.php");
require_once "classi/prodotto.php";
require_once "classi/db_connection.php";

session_start();
$db = Database::getInstance();

// Inizializzazione degli oggetti HomeGenerator e NavBar in base alla sessione
if(isset($_SESSION['id']) && $_SESSION['id']!="") {
    $navbar = new NavBar($_SESSION['id']);
} else {
    $navbar = new NavBar();
}

$id_prodotto = isset($_GET['id']) ? $_GET['id'] : null;

if($id_prodotto) {
    $where = array("ID" => $id_prodotto);
    $result = $db->read_table("prodotto", $where, "i");
    $row = $result->fetch_assoc();

    $prodotto = new Prodotto(
        $row['ID'],
        $row['nome'],
        $row['descrizione'],
        $row['prezzo'],
        $row['quantita'],
        $row['img_path']
    );

    if(isset($_SESSION['id']) && $_SESSION['id']!="") {
        $id_utente = $_SESSION['id'];
        $where = array(
            "id_user" => $id_utente, 
            "id_prodotto" => $id_prodotto
        );
        $result = $db->insert("visite_prodotto", $where, "ii");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <style>
        /* Personalizzazione stili */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding-top: 50px; /* Spazio sopra l'header per il navbar */
        }
        .container {
            margin-top: 20px;
        }
        .product-img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
        #new_quantita {
            width: 100px;
            margin-right: 10px;
        }
        #modifica_quantita {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        #modifica_quantita:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
        echo $navbar->showNavbar();
        if(isset($prodotto)){
            echo '<div class="container">';
            echo $prodotto->showProdPage();
            if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1){
    ?>
    <div class="form-group">
        <label for="new_quantita">Nuova Quantità:</label>
        <input type="number" class="form-control" name="new_quantita" id="new_quantita">
        <button id="modifica_quantita" class="btn btn-primary">Modifica Quantità</button>
    </div>
    <?php
            }
            echo '</div>';
        }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#modifica_quantita").click(function(){
                var new_quantita = $("#new_quantita").val();
                var id_prodotto = "<?php echo $id_prodotto; ?>";
                window.location.href = "script/modifica_quantita_prod.php?id=" + id_prodotto + "&quantita=" + new_quantita;
            });
        });
    </script>
</body>
</html>

