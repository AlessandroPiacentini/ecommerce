<!DOCTYPE html>
<html>
<head>
    <title>Pagina di Checkout</title>
</head>
<body>
    <h2>Checkout</h2>
    <form action="/submit-checkout" method="post">
        <h3>Dati di Spedizione</h3>
        
        <label for="address">Indirizzo:</label><br>
        <input type="text" id="address" name="address"><br>
        
        

        <h3>Dati per il Pagamento</h3>
        
        <label for="ccnum">Numero della Carta di Credito:</label><br>
        <input type="text" id="ccnum" name="ccnum"><br>
        <label for="expyear">Scadenza:</label><br>
        <input type="text" id="expyear" name="expyear"><br>
        <label for="cvv">CVV:</label><br>
        <input type="text" id="cvv" name="cvv"><br>

        <input type="submit" value="Invia">
    </form>
</body>
</html>
