<?php
// Richiedi il file di connessione al database
require_once "db_connection.php";

// Definizione della classe Timer
class Timer{
    // Attributi della classe
    private $id_utente;
    private $db;

    // Costruttore della classe
    public function __construct($id_utente){
        // Inizializzazione degli attributi
        $this->id_utente=$id_utente;
        $this->db=Database::getInstance();
    }
    
    // Metodo per fermare il timer
    public function stop(){
        $where=array(
            "idUtente" => $this->id_utente
        );
        $filed=array(
            "time" => -1
        );
        $this->db->updatetable("timer", $filed, $where, "ii");
    }

    // Metodo per avviare il timer
    public function start(){
        $where=array(
            "idUtente" => $this->id_utente
        );
        $result=$this->db->read_table("timer", $where, "i");
        if($result->num_rows>0){
            $time=time();
            $filed=array(
                "time" => $time
            );
            
            $this->db->updatetable("timer", $filed, $where, "ii");

        }else{
            $time=time();
            $filed=array(
                "idUtente" => $this->id_utente,
                "time" => $time
            );
            $this->db->insert("timer", $filed, "ii");   
        }   
    }

    // Metodo per ottenere i secondi trascorsi
    public function getSecond(){
        $where=array(
            "idUtente" => $this->id_utente
        );
        $result=$this->db->read_table("timer", $where, "i");
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            $time=$row['time'];

            if($time==-1){
                return -1;
            }
    
            $secondi=(time()-$time);
    
            return $secondi; 
        }
    }
}
?>
