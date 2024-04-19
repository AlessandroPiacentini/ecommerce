<?php
require_once "classi/db_connection.php";
require_once "classi/navbar.php";
session_start();
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
    
</head>
<body>
    <?php
        echo $navbar->showNavbar();
    ?>
    <h2>Modifica Profilo</h2>
    <form action="script/check_modifiche.php">
        <label for="username">Username</label>
        <input type="text" name="username" id="username"><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" ><br>
        <label for="telefono">Telefono</label>
        <input type="text" name="telefono" id="telefono" ><br>
        <input type="submit" value="Modifica">
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>