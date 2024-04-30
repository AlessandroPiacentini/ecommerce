<?php 
session_start(); // Avvia la sessione per poter utilizzare le variabili di sessione

require_once "../classi/db_connection.php"; // Includi il file che contiene la classe per la connessione al database
$db = Database::getInstance(); // Ottieni un'istanza della classe per la connessione al database

if(isset($_POST['prodotto_id'])){ // Verifica se è stato inviato un ID del prodotto tramite il metodo POST
    
    $prodotto_id = $_POST['prodotto_id']; // Ottieni l'ID del prodotto dall'array $_POST
    
    // Verifica se l'utente è loggato tramite sessione e ha un ID valido
    if(isset($_SESSION['id']) and $_SESSION['id'] != "" ){
        $idutente = $_SESSION['id']; // Ottieni l'ID dell'utente dalla sessione
    }
    else{
        // Se l'utente non è loggato tramite sessione, controlla se ha un ID valido nei cookie
        if(isset($_COOKIE['id_utente']) and $_COOKIE['id_utente'] != ""){
            $idutente = $_COOKIE['id_utente']; // Ottieni l'ID dell'utente dai cookie
        }
        else{
            // Se l'utente non ha un ID valido ne in sessione ne nei cookie, ottieni il massimo ID degli utenti dal database e incrementalo per ottenere un nuovo ID
            $result= $db->execute_query("SELECT MAX(ID) as id FROM utente");
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $idutente = $row['id'] + 1; // Incrementa l'ID massimo per ottenere un nuovo ID univoco
            }
            setcookie("id_utente", $idutente); // Imposta l'ID dell'utente nei cookie
            $where = ["ID" => $idutente, "isAdmin" => 0];
            $db->insert("utente", $where, "ii"); // Inserisci il nuovo utente nel database con il nuovo ID generato
        }
    }

    // Verifica se esiste già un carrello attivo per l'utente
    $where = [ "id_utente" => $idutente, "attivo" => 1];
    $result = $db->read_table("carrello", $where, "ii");
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $idCarrello = $row['ID']; // Ottieni l'ID del carrello se esiste già
    }else{
        // Se non esiste un carrello attivo per l'utente, crea un nuovo carrello e ottieni il suo ID
        $where = ["id_utente" => $idutente, "attivo" => 1];
        $db->insert("carrello", $where, "ii");
        $result = $db->read_table("carrello", $where, "ii");
        $row = $result->fetch_assoc();
        $idCarrello = $row['ID']; // Ottieni l'ID del nuovo carrello appena creato
    }

    $_SESSION['id_carrello'] = $idCarrello; // Imposta l'ID del carrello nella sessione dell'utente

    // Ottieni le informazioni del prodotto dal database
    $where = ["ID" => $prodotto_id];
    $result = $db->read_table("prodotto", $where, "i");
    $row = $result->fetch_assoc();
    $quantita = $row['quantita']; // Ottieni la quantità disponibile del prodotto
    
    if($quantita > 0){ // Verifica se la quantità disponibile è maggiore di zero
        if(!($quantita > 1)){ // Verifica se la quantità disponibile è esattamente 1
            $prodotto_temporaneo=true;

            require_once "../classi/timer.php";

            $timer = Timer::getInstance();
            $timer->start();
        }else{
            $prodotto_temporaneo=false;
        }
        
        $quantita--; // Riduci la quantità disponibile del prodotto di 1
        $field = ["quantita" => $quantita];
        $where = ["ID" => $prodotto_id];
        $db->updateTable("prodotto", $field, $where, "ii"); // Aggiorna la quantità disponibile del prodotto nel database
        
        // Verifica se il prodotto è già presente nel carrello dell'utente
        $where = ["idProdotto" => $prodotto_id, "idCarrello" => $idCarrello];
        $result = $db->read_table("aggiunta_carrello", $where, "ii");
        if($result->num_rows > 0){ // Se il prodotto è già presente nel carrello
            $row = $result->fetch_assoc();
            $quantita = $row['quantita_carrello'];
            $quantita++; // Aumenta la quantità del prodotto nel carrello di 1
            $field = ["quantita_carrello" => $quantita, "temporaneo"=>$prodotto_temporaneo];
            $where= ["idProdotto" => $prodotto_id, "idCarrello" => $idCarrello];
            $db->updateTable("aggiunta_carrello", $field, $where, "iiii"); // Aggiorna la quantità del prodotto nel carrello nel database
        }else{
            
            // Se il prodotto non è ancora presente nel carrello dell'utente, inserisci una nuova riga nel carrello con la quantità 1
            $where = ["idProdotto" => $prodotto_id, "idCarrello" => $idCarrello, "quantita_carrello" => 1,  "temporaneo"=>$prodotto_temporaneo];
            $db->insert("aggiunta_carrello", $where, "iiii");
        }
    }

    header("Location: ../home.php?msg=added"); // Reindirizza l'utente alla pagina home con un messaggio di conferma
}
