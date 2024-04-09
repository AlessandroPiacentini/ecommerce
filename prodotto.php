<?php
class Prodotto {
    private $id;
    private $nome;
    private $descrizione;
    private $data;
    private $prezzo;
    private $quantita;
    private $path;


    public function __construct($id, $nome, $descrizione, $data, $prezzo, $quantita, $path) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->data = $data;
        $this->prezzo = $prezzo;
        $this->quantita = $quantita;
        $this->path = $path;
    }

    public function  getId() { return $this->id; }

    public function getNome() {
        return $this->nome;
    }

    public function getDescrizione() {
        return $this->descrizione;
    }

    public function getData() {
        return $this->data;
    }

    public function getPrezzo() {
        return $this->prezzo;
    }

    public function getQuantita() {
        return $this->quantita;
    }

    public function getPath(){
        return $this->path;
    }

    public function showProd(){
        if($this->path){
            $s="<a href='page_prodotto.php?id=$this->id'><div><img src='img/$this->path' width='150' height='150'>";
        }
        else{
            $s="<a href='page_prodotto.php?id=$this->id'><div><img src='img/default-image.jpg' width='150' height='150'>";
        }
        $s.="<br><h4>$this->nome</h4>   $this->prezzo</div></a>";

        return $s;
    }
}
?>


