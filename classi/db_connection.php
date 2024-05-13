<?php
// Definizione della classe Database
class Database {
    private static $instance;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "ecommerce";
    private $conn;

    // Costruttore privato per prevenire l'istanziazione esterna
    private function __construct() {
        // Connessione al database
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Verifica della connessione
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Metodo per ottenere l'istanza del database
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    // Metodo per aggiornare una tabella nel database
    function updateTable($table, $fields, $where=null, $type_where=null) {
        // Creazione della query SQL
        $sql = "UPDATE " . $table . " SET ";
        $params = [];
        foreach ($fields as $field => $value) {
            $sql .= $field . " = ?, ";
            $params[] = $value;
        }
        // Rimozione dell'ultima virgola e dello spazio
        $sql = rtrim($sql, ', ');
        if ($where !== null) {
            // Aggiunta delle condizioni WHERE
            $sql .= " WHERE ";
            foreach ($where as $field => $value) {
                $sql .= $field . " = ? AND ";
                $params[] = $value;
            }
            // Rimozione dell'ultimo "AND "
            $sql = rtrim($sql, "AND ");
        }
        // Preparazione dello statement
        $stmt = $this->conn->prepare($sql);
    
        // Verifica del tipo di condizioni WHERE
        if($type_where==null)
            $s= str_repeat('s', count($params));
        else
            $s=$type_where;
        // Bind dei parametri
        $stmt->bind_param($s, ...$params);
    
        // Esecuzione dello statement
        $stmt->execute();
    
        // Chiusura dello statement
        $stmt->close();
    }
    
    // Metodo per eseguire una query SQL arbitraria
    function execute_query($sql){
        return $this->conn->execute_query($sql);
    }
    
    // Metodo per leggere una tabella dal database
    function read_table($table, $where = null, $type_where=null) {
        // Inizio della query SQL
        $sql = "SELECT * FROM $table";
    
        // Se è stata fornita una clausola WHERE, aggiungila alla query SQL
        if ($where !== null) {
            $sql .= " WHERE ";
            $params = [];
            foreach ($where as $field => $value) {
                $sql .= "$field = ? AND ";
                $params[] = $value;
            }
            // Rimozione dell'ultimo ' AND '
            $sql = substr($sql, 0, -5);
            // Preparazione della query SQL
            $conn = $this->conn;
            $stmt = $conn->prepare($sql);
            if($type_where==null)
                $s= str_repeat('s', count($params));
            else
                $s=$type_where;
            // Bind dei parametri
            $stmt->bind_param($s, ...$params);
        } else {
            // Preparazione della query SQL senza parametri
            $conn = $this->conn;
            $stmt = $conn->prepare($sql);
        }
        
        // Esecuzione dello statement
        $stmt->execute();
    
        // Ottenimento del risultato
        $result = $stmt->get_result();
    
        // Chiusura dello statement
        $stmt->close();
    
        return $result;
    }

    // Metodo per eliminare dati dalla tabella nel database
    public function delete($table, $where, $type_where=null){
        $sql = "DELETE FROM $table WHERE ";
        $params = [];
        foreach ($where as $field => $value) {
            $sql .= "$field = ? AND ";
            $params[] = $value;
        }
        $sql = substr($sql, 0, -5);
        $stmt = $this->conn->prepare($sql);
        if($type_where==null)
            $s= str_repeat('s', count($params));
        else
            $s=$type_where;
        $stmt->bind_param($s, ...$params);
        $stmt->execute();
        $stmt->close();
    }

    // Metodo per inserire dati nella tabella nel database
    public function insert($table, $where, $type_where=null){
        $sql = "INSERT INTO $table (";
        $values = " VALUES (";
        $params = [];
        foreach ($where as $field => $value) {
            $sql .= $field . ", ";
            $values .= "?, ";
            $params[] = $value;
        }
        $sql = rtrim($sql, ', ') . ")";
        $values = rtrim($values, ', ') . ")";
        $sql .= $values;

        $stmt = $this->conn->prepare($sql);
        if($type_where==null)
            $s= str_repeat('s', count($params));
        else
            $s=$type_where;
        $stmt->bind_param($s, ...$params);
        $stmt->execute();
        $stmt->close();
    }
}
?>
