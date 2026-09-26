<?php
require_once __DIR__ .'/db_cred.php';
class Database
{
    private $conn; 

    private $host = SERVER; 
    private $dbname = DATABASE; 
    private $username = USERNAME; 
    private $password = PASSWD;

    public function __construct()
    { 
        try 
        {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->username,
                $this->password

            );


            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function fetchAll($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchOne($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function execute($sql, $params = [])
{
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute($params);
}

}