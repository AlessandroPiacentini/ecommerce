<?php
session_start();
$_SESSION['username'] = "";
$_SESSION['id'] = "";
header("Location: ../home.php");
?>
