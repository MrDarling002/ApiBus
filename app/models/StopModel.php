<?php
class StopModel {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getStopName($stopId) {
        $result = $this->db->query("SELECT name FROM Stop WHERE id = :id", ['id' => $stopId]);
        return $result[0]['name'] ?? null;
    }
}