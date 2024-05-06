<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="script/add_Mpagamento.php">
        <h3>Dati per il Pagamento</h3>
        
        <label for="ccnum">Numero della Carta di Credito:</label><br>
        <input type="text" id="ccnum" name="ccnum"><br>
        <label for="expmonth">Mese di Scadenza:</label><br>
        <input type="text" id="expmonth" name="expmonth"><br>
        <label for="expyear">Anno di scadenza:</label><br>
        <input type="text" id="expyear" name="expyear"><br>
        <label for="cvv">CVV:</label><br>
        <input type="text" id="cvv" name="cvv"><br>


        <input type="submit" value="Invia">
    </form>
</body>
</html>