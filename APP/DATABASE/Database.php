<?php

Class Database {
    private $conn;
    private string $local = '192.168.22.9';
    private string $db = 'passcontrol';
    private string $user = 'fabrica32';
    private string $password = 'fabrica2025';
    private string $table = 'guiche';

    function __construct($table = null){
        if ($table) {
            $this->table = $table;
        }
        $this->conecta();
    }

    // Conectar ao banco de dados
    private function conecta(){
        try {
            $this->conn = new PDO("mysql:host=".$this->local.";dbname=$this->db", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $err) {
            die("Connection Failed: " . $err->getMessage());
        }
    }

    // Executa uma consulta no banco de dados
    public function execute($query, $binds = []){
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($binds);
            return $stmt;
        } catch(PDOException $err) {
            die("Query Failed: " . $err->getMessage());
        }
    }

    // Função para inserir novos dados
    public function insert($values){
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');
        
        // Cria a query de inserção
        $query = 'INSERT INTO '.$this->table.'('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';
        
        // Executa a inserção e verifica se foi bem-sucedida
        $stmt = $this->execute($query, array_values($values));
        
        // Retorna o ID do último inserido
        return $stmt ? $this->conn->lastInsertId() : false;
    }

    // Função para selecionar dados
    public function select($where = null, $order = null, $limit = null, $fields = '*'){
        $where = $where ? 'WHERE '.$where : '';
        $order = $order ? 'ORDER BY '.$order : '';
        $limit = $limit ? 'LIMIT '.$limit : '';
        
        // Cria a query de seleção
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;
        
        return $this->execute($query);
    }

    // Função para excluir dados
    public function delete($where){
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;
        $del = $this->execute($query);
        
        // Verifica se a exclusão foi bem-sucedida
        return $del->rowCount() === 1;
    }

    // Função para atualizar dados
    public function update($where, $array){
        $fields = array_keys($array);
        $values = array_values($array);
        
        // Cria a query de atualização
        $query = 'UPDATE '.$this->table.' SET '.implode('=?, ', $fields).'=? WHERE '.$where;
        
        // Executa a atualização e retorna o número de linhas afetadas
        $res = $this->execute($query, $values);
        
        return $res->rowCount();
    }
}

?>
