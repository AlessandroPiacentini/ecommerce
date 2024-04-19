<?php
class Categoria {
    private $id;
    private $nome;
    private $descrizione;

    public function __construct($id, $nome, $descrizione) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
    }

    // Metodo per ottenere l'id della categoria
    public function getid() {
        return $this->id;
    }

    // Metodo per impostare l'id della categoria
    public function setid($id) {
        $this->id = $id;
    }

    // Metodo per ottenere il nome della categoria
    public function getNome() {
        return $this->nome;
    }

    // Metodo per impostare il nome della categoria
    public function setNome($nome) {
        $this->nome = $nome;
    }

    // Metodo per ottenere la descrizione della categoria
    public function getDescrizione() {
        return $this->descrizione;
    }

    // Metodo per impostare la descrizione della categoria
    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }

    
    public function showCategoria(){
        $s="<a href='page_categoria.php?id=$this->id'><div>";
        
        
        $s.="<br><h4>$this->nome</h4></div></a>";

        return $s;
    }
}
?>
