<?php
require_once "classi/db_connection.php";
require_once "classi/categoria.php";
require_once "classi/navbar.php";

$db = Database::getInstance();
session_start();
if (isset($_SESSION['id']) && $_SESSION['id'] != "") {
    $navbar = new NavBar($_SESSION['id']);
} else {
    $navbar = new NavBar();
}
$result = $db->read_table("categoria");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Aggiungi stili personalizzati qui */
        .category-column {
            border: 1px solid #dee2e6; /* Colore dei bordi */
            border-radius: 5px; /* Arrotonda i bordi */
            padding: 15px; /* Spazio interno */
            margin-bottom: 20px; /* Margine inferiore */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php echo $navbar->showNavbar(); ?>

    <div class="container">
        <h2 class="mt-4 mb-3">Categorie</h2>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) {
                // Creazione dell'oggetto Categoria
                $categoria = new Categoria($row['ID'], $row['nome'], $row['descrizione']);
                // Visualizzazione della categoria
                echo "<div class='col-md-3'>";
                echo "<div class='category-column'>";
                echo $categoria->showCategoria();
                echo "</div>";
                echo "</div>";
            } ?>
        </div>
    </div>

    <!-- Collegamento a Bootstrap JS (Opzionale, se necessario) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
