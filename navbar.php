<?php
class NavBar{
    private $id_user;

    public function __construct($id_user=null) {
        $this->id_user = $id_user;
    }

    
    public function  showNavbar(){
        $s='<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="home.php">Il mio sito</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="page_categorie.php">Categories</a>
                </li>
                <li class="nav-item">';
        if($this->id_user){
            $s.="<a class='nav-link' href='profilo.php?id=".$this->id_user."'>Profile</a>";
            $s.= "<li  class='nav-item'>";
            $s.= "<a class='nav-link' href='logout.php'>Log out</a> ";
            $s.= "</li>";
        }
        else{
            $s.="<a class='nav-link' href='login.php'>You are not logged in  </a>";
        } 
        $s.="</ul></div></nav>";

        return $s;
    }

    


}


