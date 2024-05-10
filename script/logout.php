<?php
session_start();
$_SESSION['username'] = "";
$_SESSION['id'] = "";
$_SESSION['id_carrello'] = "";
$_SESSION['isAdmin'] = "";
header("Location: ../home.php");
?>
