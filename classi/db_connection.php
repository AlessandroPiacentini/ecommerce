<?php
class Database {
    private static $instance;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "ecommerce";
    private $conn;

    private function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }
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
    
        if($type_where==null)
                $s= str_repeat('s', count($params));
            else
                $s=$type_where;
            // Bind the parameters
            $stmt->bind_param($s, ...$params);
    
        // Esecuzione dello statement
        $stmt->execute();
    
        // Chiusura dello statement
        $stmt->close();
    }
    
    function execute_query($sql){
        return $this->conn->execute_query($sql);
    }
    
    function read_table($table, $where = null, $type_where=null) {
        // Start the SQL statement
        $sql = "SELECT * FROM $table";
    
        // If a WHERE clause was provided, add it to the SQL statement
        if ($where !== null) {
            $sql .= " WHERE ";
            $params = [];
            foreach ($where as $field => $value) {
                $sql .= "$field = ? AND ";
                $params[] = $value;
            }
            // Remove the last ' AND '
            $sql = substr($sql, 0, -5);
            // Prepare the SQL statement
            $conn = $this->conn;
            $stmt = $conn->prepare($sql);
            if($type_where==null)
                $s= str_repeat('s', count($params));
            else
                $s=$type_where;
            // Bind the parameters
            $stmt->bind_param($s, ...$params);
        } else {
            // Prepare the SQL statement without any parameters
            $conn = $this->conn;
            $stmt = $conn->prepare($sql);
        }
        
        // Execute the statement
        $stmt->execute();
    
        // Get the result
        $result = $stmt->get_result();
    
        // Close the statement
        $stmt->close();
    
        return $result;
    }

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

    public function BoT(){
        $this->conn->begin_transaction();
        $f=fopen("../log.txt", "a");
            fwrite($f, "inizia la transazione\n");

    }

    public function commit(){
        
        $this->conn->commit();
        $f=fopen("../log.txt", "a");
            fwrite($f, "termina la transazione\n");
        
    }

    public function rollback(){
        $this->conn->rollback();

    }



    
}
?>