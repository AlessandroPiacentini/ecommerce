<?php
include "db_connection.php";
require_once "prodotto.php";

class HomeGenerator {
    private $idutente;
    private $db;

    public function __construct($idutente = null) {
        $this->idutente = $idutente;
        $this->db = Database::getInstance();
    } 

    public function get_products() {
        $array_products = [];

        if ($this->idutente) { 
            $categories = $this->get_categories();
            if ($categories) {
                foreach ($categories as $category) {
                    $where = ["idCategoria" => $category["id"]];
                    $result = $this->db->read_table("appartiene JOIN prodotto on appartiene.idProdotto = prodotto.ID", $where, "i");
                    $array_products = $this->count_products($result, $array_products);
                }
            } else {
                $result = $this->db->read_table("prodotto");
                $array_products = $this->count_products($result, $array_products);
            }
        } else {
            $result = $this->db->read_table("prodotto");
            $array_products = $this->count_products($result, $array_products);
        }

        $array_products = $this->sortByCountDescending($array_products);
        return $array_products; 
    }

    private function sortByCountDescending($array) {
        usort($array, function($a, $b) {
            return $b['count'] <=> $a['count'];
        });

        return $array;
    }   

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

    private function count_products($result, $array) {
        while ($row = $result->fetch_assoc()) {
            $prodottto = new Prodotto(
                $row['ID'],
                $row['nome'],
                $row['descrizione'],
                $row['prezzo'],
                $row['quantita'],
                $row['img_path']
            );
            $id_prodotto = $this->idutente ? $row['ID'] : $row['ID'];
            $result_query = $this->db->execute_query("SELECT COUNT(*) AS contatore FROM visite_prodotto WHERE id_prodotto = $id_prodotto");
            $row_query = $result_query->fetch_assoc();

            $array[] = ["prodotto" => $prodottto, "count" => $row_query['contatore']];
        }
        
        return $array;
    }
}
?>
