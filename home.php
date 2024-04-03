<?php
include("genera_home.php");

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="home.php">Il mio sito</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="categorie.php">Categories</a>
                </li>
                <li class="nav-item">

                    <?php
                    if((isset($_SESSION['username'])) ){
                        if($_SESSION['username']!=""){
                            echo "<a class='nav-link' href='profilo.php'>Profile</a>";
                        }
                        else{
                            echo "<a class='nav-link' href='login.php'>You are not logged in  </a>";
                        } 
                    }
                    else{
                        echo "<a class='nav-link' href='login.php'>You are not logged in  </a>";
                    } 
                    ?>
                    
                </li>
                    <?php
                        if((isset($_SESSION['username']))) {
                            if($_SESSION['username']!=""){
                                echo "<li  class='nav-item'>";
                                echo "<a class='nav-link' href='logout.php'>Log out</a> ";
                                echo "</li>";
                            }
                        }
                    ?>
                    
                
            </ul>
        </div>
    </nav>

    <?php 
        if((isset($_SESSION['username']))) {
            if($_SESSION['username']!=""){
                $home=new HomeGenerator($_SESSION['id']);
            }
            else{
                $home=new HomeGenerator();
            }
        }
        else{
            $home=new HomeGenerator();
        }
        print_r(json_encode($home->get_prodacts()));
    ?>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
