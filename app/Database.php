<?php
class Database {
    private $connection;

    public function __construct() {
        $this->connection = new PDO('pgsql:host=db;dbname=bus_schedule', 'postgres', 'password');
    }

    public function query($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}