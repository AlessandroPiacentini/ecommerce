<?php
    session_start();
    require_once "classi/db_connection.php";
    require_once "classi/navbar.php";
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
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php
        echo $navbar->showNavbar();
    ?>
    <div>
        <h2>Ordini</h2>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Carrello</th>
                        <th>Indirizzo</th>
                        <th>Data</th>
                        <th>Stato</th>
                        <th>Id Utente</th>
                    </tr>
                </thead>
                <tbody id="ordini">
                    
                </tbody>
            </table>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
        $(document).ready(function(){
            get_ordini();
        });

        function get_ordini(){
            $.ajax({
                url: "script/get_ordini.php",
                type: "GET",
                dataType: "json", 
                success: function(data){
                    console.log(data);
                    for(let i=0; i<data.length; i++){
                        $("#ordini").append("<tr><td>"+data[i]["ID"]+"</td><td>"+data[i]["indirizzo"]+"</td><td>"+data[i]["data_acquisto"]+"</td><td>"+data[i]["stato"]+"</td><td>"+data[i]["id_utente"]+"</td></tr>");
                    }
                }
            });
        }
    </script>


</body>
</html>