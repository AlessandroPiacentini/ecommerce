<?php
class NavBar{
    private $id_user;

    public function __construct($id_user=null) {
        $this->id_user = $id_user;
    }

    
    public function showNavbar() {
        $s = '<nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="home.php">Il mio sito</a>
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
    
        if ($this->id_user) {
            $s .= '<li class="nav-item">
                        <a class="nav-link" href="profilo.php?id=' . $this->id_user . '">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="script/logout.php">Log out</a>
                    </li>';
        } else {
            $s .= '<li class="nav-item">
                        <a class="nav-link" href="login.php">You are not logged in</a>
                    </li>';
        }
    
        $s .= '<li class="nav-item">
                    <a class="nav-link" href="page_carrello.php">Carrello</a>
                </li>
            </ul>
        </div>
    </nav>';
    
        return $s;
    }
    
    

}


