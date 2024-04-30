<?php
echo "eliminerò tutti i prodotti temporanei nel carrello";

$f=fopen("timer.txt", "w");
fwrite($f, 0);

fclose($f);

