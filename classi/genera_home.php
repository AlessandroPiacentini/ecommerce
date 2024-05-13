<?php
// Includi il file di connessione al database
include "db_connection.php";

// Richiedi il file contenente la classe Prodotto
require_once "prodotto.php";

// Definizione della classe HomeGenerator
class HomeGenerator {
    // Attributi della classe
    private $idutente;
    private $db;

    // Costruttore della classe
    public function __construct($idutente = null) {
        // Inizializzazione degli attributi
        $this->idutente = $idutente;
        $this->db = Database::getInstance();
    } 

    // Metodo per ottenere i prodotti
    public function get_products() {
        $array_products = [];

        // Se è stato fornito un idutente, ottieni i prodotti in base alle categorie preferite dell'utente
        if ($this->idutente) { 
            $categories = $this->get_categories();
            if ($categories) {
                foreach ($categories as $category) {
                    // Ottieni i prodotti appartenenti alla categoria corrente
                    $where = ["idCategoria" => $category["id"]];
                    $result = $this->db->read_table("appartiene JOIN prodotto on appartiene.idProdotto = prodotto.ID", $where, "i");
                    $array_products = $this->count_products($result, $array_products);
                }
            } else {
                // Se l'utente non ha categorie preferite, ottieni tutti i prodotti
                $result = $this->db->read_table("prodotto");
                $array_products = $this->count_products($result, $array_products);
            }
        } else {
            // Se non è stato fornito un idutente, ottieni tutti i prodotti
            $result = $this->db->read_table("prodotto");
            $array_products = $this->count_products($result, $array_products);
        }

        // Ordina i prodotti per il numero di visite in ordine decrescente
        $array_products = $this->sortByCountDescending($array_products);
        return $array_products; 
    }

    // Metodo privato per ordinare l'array di prodotti per il numero di visite in ordine decrescente
    private function sortByCountDescending($array) {
        usort($array, function($a, $b) {
            return $b['count'] <=> $a['count'];
        });

        return $array;
    }   

    // Metodo privato per ottenere le categorie preferite dell'utente
    private function get_categories() {
        $from = "categorie_preferite";
        $where = ["id_user" => $this->idutente];
        $result = $this->db->read_table($from, $where, "i");

        if ($result->num_rows > 0) {
            $count_categories = $this->count_categories($result);
            return $this->sortByCountDescending($count_categories);
        }
        
        return null;
    }

    // Metodo privato per contare le categorie
    private function count_categories($result) {
        $count_categories = [];
        $cat = "";
        $count = 0;

        while ($row = $result->fetch_assoc()) {
            if ($cat == $row['id_categoria']) {
                $count++;
            } else {
                if ($count > 0) {
                    $count_categories[] = ["id" => $cat, "count" => $count];
                }
                
                $cat = $row['id_categoria'];
                $count = 1;
            }
        }

        if ($count > 0) {
            $count_categories[] = ["id" => $cat, "count" => $count];
        }
        
        return $count_categories;
    }

    // Metodo privato per contare i prodotti
    private function count_products($result, $array) {
        while ($row = $result->fetch_assoc()) {
            // Creazione di un oggetto Prodotto
            $prodottto = new Prodotto(
                $row['ID'],
                $row['nome'],
                $row['descrizione'],
                $row['prezzo'],
                $row['quantita'],
                $row['img_path']
            );
            $id_prodotto = $this->idutente ? $row['ID'] : $row['ID'];
            // Esegui una query per contare il numero di visite per ciascun prodotto
            $result_query = $this->db->execute_query("SELECT COUNT(*) AS contatore FROM visite_prodotto WHERE id_prodotto = $id_prodotto");
            $row_query = $result_query->fetch_assoc();

            // Aggiungi il prodotto e il conteggio al nuovo array
            $array[] = ["prodotto" => $prodottto, "count" => $row_query['contatore']];
        }
        
        return $array;
    }
}
?>
