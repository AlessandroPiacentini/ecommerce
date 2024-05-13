<?php
// Definizione della classe NavBar
class NavBar{
    // Attributo della classe per l'ID dell'utente
    private $id_user;

    // Costruttore della classe
    public function __construct($id_user=null) {
        $this->id_user = $id_user;
    }

    // Metodo per mostrare la barra di navigazione
    public function showNavbar() {
        // Costruzione della stringa HTML per la navbar
        $s = '<nav class="navbar navbar-expand-md navbar-light bg-light">
                <a class="navbar-brand" href="home.php">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="page_categorie.php">Categories</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">';
        
        // Se l'ID dell'utente è presente, mostra i link per il profilo e il logout
        if ($this->id_user) {
            $s .= '<li class="nav-item">
                        <a class="nav-link" href="profilo.php?id=' . $this->id_user . '">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="script/logout.php">Log out</a>
                    </li>';
        } else {
            // Altrimenti, mostra il link per il login
            $s .= '<li class="nav-item">
                        <a class="nav-link" href="login.php">You are not logged in</a>
                    </li>';
        }
        
        // Aggiungi i link per il carrello e gli ordini
        $s .= '<li class="nav-item">
                    <a class="nav-link" href="page_carrello.php">Carrello</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page_ordini.php">Ordini</a>
                </li>
            </ul>
        </div>
    </nav>';
    
        return $s;
    }  
}
?>
