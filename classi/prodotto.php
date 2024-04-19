<?php
class Prodotto {
    private $id;
    private $nome;
    private $descrizione;
    private $prezzo;
    private $quantita;
    private $path;


    public function __construct($id, $nome, $descrizione, $prezzo, $quantita, $path) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->prezzo = $prezzo;
        $this->quantita = $quantita;
        if($path){

            $this->path = $path;
        }
        else{
            $this->path="default-image.jpg";
        }
    }

    public function  getId() { return $this->id; }

    public function getNome() {
        return $this->nome;
    }

    public function getDescrizione() {
        return $this->descrizione;
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
    private function getProd(){
        return new Prodotto($this->id, $this->nome, $this->descrizione, $this->prezzo, $this->quantita, $this->path);
    }

    public function showProdHome(){
        $s="<a href='page_prodotto.php?id=$this->id'><div class='col'><img src='img/$this->path' width='150' height='150'>";
        
        
        $s.="<br><h4>$this->nome</h4>   $this->prezzo</div></a>";

        return $s;
    }

    public function showProdPage(){
        $s='<div class="container">';
        $s.='<div class="product-img">';
        $s.='<img src="img/'.$this->path.'" class="img-fluid" alt="Immagine Prodotto">';
        $s.='</div>';
        $s.='<div class="card">';
        $s.='<div class="card-body">';
        $s.='<h2 class="card-title">'.$this->nome.'</h2>';
        $s.='<p class="card-text">'.$this->descrizione.'</p>';
        $s.='<p class="card-text"><strong>Prezzo:</strong> $'.$this->prezzo.'</p>';
        $s.='<p class="card-text"><strong>Quantità Disponibile:</strong>'.$this->quantita.'</p>';
        $s.='</div>';
        $s.='</div>';

        $s.='<form action="script/aggiungi_carrello.php" method="post">';
        $s.='<input type="hidden" name="prodotto_id" value="'.$this->id.'">';
        $s.='<input type="submit" name"addProd" class="btn btn-primary" value="Aggiungi al Carrello">';
        $s.='</form>';
        $s.='</div>';


        return $s;
    }
    public function showProdCarrello($quantita_carrello){
        $s='<div class="container">';
        $s.='<div class="product-img">';
        $s.='<img src="img/'.$this->path.'" class="img-fluid" alt="Immagine Prodotto" width="150" height="150">';
        $s.='</div>';
        $s.='<div class="card">';
        $s.='<div class="card-body">';
        $s.='<h2 class="card-title">'.$this->nome.'</h2>';
        $s.='<p class="card-text">'.$this->descrizione.'</p>';
        $s.='<p class="card-text"><strong>Prezzo:</strong> $'.$this->prezzo.'</p>';
        $s.='<p class="card-text"><strong>Quantità:</strong>'.$quantita_carrello.'</p></div></div></div>';

        return $s;
        
    }
}
?>


