<?php
require_once "../classi/db_connection.php";
$db = Database::getInstance();

$result=$db->read_table("categoria");

$categorie=array();

while($row=$result->fetch_assoc()){
    array_push($categorie, $row);
}

echo json_encode($categorie);