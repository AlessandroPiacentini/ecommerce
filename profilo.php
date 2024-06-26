<?php
require_once "classi/db_connection.php";
require_once "classi/navbar.php";
require_once "classi/utente.php";

session_start();

$db = Database::getInstance();

if(isset($_SESSION['id']) && $_SESSION['id']!="") {
    $navbar = new NavBar($_SESSION['id']);
} else {
    $navbar = new NavBar();
}

$result= $db->read_table("utente", ["ID" => $_SESSION['id']], "i");
if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $utente = new Utente($row['ID'], $row['username'], $row['email'], $row['telefono']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>
    <?php
        echo $navbar->showNavbar();
        echo "<h1>Profilo</h1>";
        echo $utente->showUtente();
    ?>

    <a href="modifica_profilo.php" class="btn btn-primary">Modifica</a>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>