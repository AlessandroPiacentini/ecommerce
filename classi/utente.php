<?php
class Utente{
    private $id;
    private $username;
    private $email;
    private $telefono;

    public function __construct($id, $username, $email, $telefono) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->telefono = $telefono;
    }
    public function getId() {
        return $this->id;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getTelefono() {
        return $this->telefono;
    }

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