<?php
// Definizione della classe Utente
class Utente{
    // Attributi della classe
    private $id;
    private $username;
    private $email;
    private $telefono;

    // Costruttore della classe
    public function __construct($id, $username, $email, $telefono) {
        // Inizializzazione degli attributi con i valori passati
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->telefono = $telefono;
    }

    // Metodo per ottenere l'ID dell'utente
    public function getId() {
        return $this->id;
    }

    // Metodo per ottenere il nome utente
    public function getUsername() {
        return $this->username;
    }

    // Metodo per ottenere l'email dell'utente
    public function getEmail() {
        return $this->email;
    }

    // Metodo per ottenere il numero di telefono dell'utente
    public function getTelefono() {
        return $this->telefono;
    }

    // Metodo per mostrare le informazioni dell'utente
    public function showUtente(){
        $s="<div>";
        $s.="<br><h4>$this->username</h4>";
        $s.="<br><h4>$this->email</h4>";
        $s.="<br><h4>$this->telefono</h4>";
        $s.="</div>";
        return $s;
    }
}
?>
