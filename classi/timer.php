<?php
require_once "db_connection.php";


class Timer{
    private $id_utente;

    private $db;

    public function __construct($id_utente){
        $this->id_utente=$id_utente;
        $db=Database::getInstance();

    }
    
    public function stop(){
        $f=fopen("timer.txt", "w");
        fwrite($f, -1);
        fclose($f);
    }

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
            
            $this->db->update("timer", $filed, $where, "ii");

        }else{
            $time=time();
            $filed=array(
                "idUtente" => $this->id_utente,
                "time" => $time
            );
            $this->db->insert("timer", $filed, "ii");   
        }

        
    }

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
