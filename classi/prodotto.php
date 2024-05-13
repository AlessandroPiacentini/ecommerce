<?php
// Definizione della classe Prodotto
class Prodotto {
    // Attributi della classe
    private $id;
    private $nome;
    private $descrizione;
    private $prezzo;
    private $quantita;
    private $path;

    // Costruttore della classe
    public function __construct($id, $nome, $descrizione, $prezzo, $quantita, $path) {
        // Inizializzazione degli attributi con i valori passati
        $this->id = $id;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->prezzo = $prezzo;
        $this->quantita = $quantita;
        // Controllo se il percorso dell'immagine è stato passato, altrimenti assegna un'immagine predefinita
        if($path){
            $this->path = $path;
        }
        else{
            $this->path="default-image.jpg";
        }
    }

    // Metodo per ottenere l'ID del prodotto
    public function getId() { return $this->id; }

    // Metodo per ottenere il nome del prodotto
    public function getNome() {
        return $this->nome;
    }

    // Metodo per ottenere la descrizione del prodotto
    public function getDescrizione() {
        return $this->descrizione;
    }

    // Metodo per ottenere il prezzo del prodotto
    public function getPrezzo() {
        return $this->prezzo;
    }

    // Metodo per ottenere la quantità disponibile del prodotto
    public function getQuantita() {
        return $this->quantita;
    }

    // Metodo per ottenere il percorso dell'immagine del prodotto
    public function getPath(){
        return $this->path;
    }

    // Metodo privato per ottenere una copia dell'oggetto Prodotto corrente
    private function getProd(){
        return new Prodotto($this->id, $this->nome, $this->descrizione, $this->prezzo, $this->quantita, $this->path);
    }

    // Metodo per mostrare il prodotto nella pagina principale
    public function showProdHome(){
        $s="<a href='page_prodotto.php?id=$this->id'><div class='col'><img src='img/$this->path' width='150' height='150'>";
        
        // Costruzione della stringa HTML per mostrare il prodotto nella pagina principale
        $s.="<br><h4>$this->nome</h4>   $this->prezzo</div></a>";

        return $s;
    }

    // Metodo per mostrare il prodotto nella pagina del singolo prodotto
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

        // Form per aggiungere il prodotto al carrello
        $s.='<form action="script/aggiungi_carrello.php" method="post">';
        $s.='<input type="hidden" name="prodotto_id" value="'.$this->id.'">';
        $s.='<input type="submit" name"addProd" class="btn btn-primary" value="Aggiungi al Carrello">';
        $s.='</form>';
        $s.='</div>';

        return $s;
    }

    // Metodo per mostrare il prodotto nella pagina del carrello
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
        $s.='<p class="card-text"><strong>Quantità:</strong>'.$quantita_carrello.'</p>
        <a href="script/elimina_prodotto_carrello.php?id_prodotto='.$this->id.'" class="btn btn-secondary">X</a>
        </div></div></div>';

        return $s;  
    }
}
?>
