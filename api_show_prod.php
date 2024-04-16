<?php


$pag=$_GET['pag']*3;
if(isset($_SESSION['id']) && $_SESSION['id']!="") {
    $home = new HomeGenerator($_SESSION['id']);
} else {
    $home = new HomeGenerator();
}

// Ottenimento dei prodotti
$prodotti = $home->get_products();


for($i=$pag; $i<$pag+3; $i++){
    if(isset($prodotti[$i])){
        echo $prodotti[$i]['prodotto']->showProdHome();
    }
}



?>