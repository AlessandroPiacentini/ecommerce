<?php
include "db_connection.php";
Class HomeGenerator{
    private $idutente;
    private $db;


    public function __construct($idutente=null){
        $this->idutente=$idutente;
        $this->db = Database::getInstance();
    } 

    public function get_prodacts(){
        $array_prodotti=array();
        if($this->idutente){ 
            $categories=$this->get_categories();
            if($categories){
                foreach($categories as $category){
                    $where=array(
                        "idCategoria"=>$category["id"]
                    );
                    $result=$this->db->read_table("appartiene JOIN prodotto on appartiene.idProdotto = prodotto.ID", $where, "i");
                    $array_prodotti=$this->count_prodatcts($result,$array_prodotti);
                    
                    
                }
            }
            else{
                $result=$this->db->read_table("prodotto");
                $array_prodotti=$this->count_prodatcts($result,$array_prodotti);
            }
        }
        else{
            $result=$this->db->read_table("prodotto");
            $array_prodotti=$this->count_prodatcts($result,$array_prodotti);
        }
        $array_prodotti=$this->sortByCountDescending($array_prodotti);
        return $array_prodotti; 
    }


    private function sortByCountDescending($array) {
        // Definiamo una funzione di confronto per usare con usort
        $compare = function ($a, $b) {
            return $b['count'] <=> $a['count'];
        };

        // Ordiniamo l'array utilizzando la funzione di confronto
        usort($array, $compare);

        return $array;
    }   

    private function get_categories(){
        $from="categorie_preferite";
        $where=array("id_user"=>$this->idutente);
        $result=$this->db->read_table($from, $where, "i");


        if($result->num_rows>0){
            $count_category=$this->count_categories($result);
            $count_category_sorted=$this->sortByCountDescending($count_category);
            return $count_category_sorted;

        }
        return null;
    }


    private function count_categories($result){
        $count_category=array();
        $cat="";
        $count=0;
        while($row=$result->fetch_assoc()){
            if($cat==$row['id_categoria']){
                $count++;
            }
            else{
                if($count>0){

                    array_push($count_category,["id"=>$cat,"count"=>$count]);
                }
                
                $cat=$row['id_categoria'];
                $count=1;
            }
            
        }
        if($count>0){

            array_push($count_category,["id"=>$cat,"count"=>$count]);
        }
        
        
        return $count_category;
    }

    private function count_prodatcts($result, $array){

        $prod="";
        $count=0;
        while($row=$result->fetch_assoc()){
            if($this->idutente){
                $result_query=$this->db->execute_query("select count(*) as contatore from visite_prodotto  where id_prodotto=".$row['idProdotto']);
            }
            else{
                $result_query=$this->db->execute_query("select count(*) as contatore from visite_prodotto  where id_prodotto=".$row['ID']);
            }
            $row_query=$result_query->fetch_assoc();
            array_push($array,["prodotto"=>$row,"count"=>$row_query['contatore']]);
            
        }
        
        return $array;
    }


    private function categories_sort($array){
        for($i=0; $i<count($array)-1; $i++){
            for ($j=$i+1;$j<count($array);$j++) {
                if ($array[$i]['count']<$array[$j]['count']) {
                    $temp = $array[$i];
                    $array[$i] = $array[$j];
                    $array[$j] = $temp;
                }
            }
        }
        return $array;
    }



    
}