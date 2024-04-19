<?php
session_start();
include "../classi/db_connection.php";
require_once "../classi/navbar.php";


$db = Database::getInstance();
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $where=array(
        "username"=>$username,
        
    );
    $result=$db->read_table("utente", $where);

    if(!($result->num_rows > 0)){
        $where=array(
            "username"=>$username,
            "password"=>$password,  
            "email"=>$email,
            "telefono"=>$phone,
            "isAdmin"=>0
        );
        $db->insert("utente", $where);

        header("Location: ../login.php?msg=success");
    }else{
        header("Location: ../register.php?msg=error");
    }
}elseif(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $where=array(
        "username"=>$username,
        "password"=>$password,
    );
    $result = $db->read_table("utente", $where);
    if($result->num_rows > 0){
        $row=$result->fetch_assoc();
        $_SESSION['id']=$row['ID'];
        $_SESSION['username'] = $username;
        $_SESSION['isAdmin'] = $row['isAdmin'];


        header("Location: ../home.php");
    }else{
        header("Location: ../login.php?msg=error");
    }
}
?>