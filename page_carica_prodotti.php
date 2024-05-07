<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Prodotto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Aggiungi Prodotto</h1>
        <form action="script/aggiungi_prodotto.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome">
            </div>
            <div class="form-group">
                <label for="descrizione">Descrizione:</label>
                <textarea class="form-control" id="descrizione" name="descrizione"></textarea>
            </div>
            <div class="form-group">
                <label for="prezzo">Prezzo:</label>
                <input type="text" class="form-control" id="prezzo" name="prezzo">
            </div>
            <div class="form-group">
                <label for="quantita">Quantità:</label>
                <input type="number" class="form-control" id="quantita" name="quantita">
            </div>
            <div class="form-group">
                <label for="categoria">categorie:</label>
                <select class="form-control" id="categoria" name="categoria">

                </select>
            </div>

            <div class="form-group">
                <label for="img_path">Percorso Immagine:</label>
                <input type="file" class="form-control" id="img_path" name="img_path">
            </div>
            <button type="submit" class="btn btn-primary">Aggiungi Prodotto</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            $.ajax({
                url: "script/get_categorie.php",
                type: "GET",
                dataType: "json", 
                success: function(data){
                    console.log(data);
                    data.forEach(function(categoria){
                        $("#categoria").append("<option value='"+categoria['ID']+"'>"+categoria['nome']+"</option>");
                    });
                }
            });
        });
    </script>
</body>
</html>
