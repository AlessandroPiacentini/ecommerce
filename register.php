<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Aggiungi stili personalizzati qui, se necessario */
        body {
            background-color: #f8f9fa; /* Cambia il colore di sfondo se desiderato */
        }
        .register-form {
            max-width: 350px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <?php
    if(isset($_GET['msg'])){
        if($_GET['msg']=="error"){
            echo "<div class='alert alert-danger' role='alert'>username già in uso</div>";
        }
    }
    ?>
    <div class="container">
        <div class="register-form">
            <h2 class="text-center mb-4">Register</h2>
            <form action="check.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control" name="phone" placeholder="Phone Number" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS e jQuery (opzionale) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
