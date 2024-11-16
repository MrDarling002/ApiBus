<?php
class ScheduleModel {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getNextArrivals($routeId, $stopId) {
        return $this->db->query("
            SELECT arrival_time
            FROM Schedule
            WHERE route_id = :route_id AND stop_id = :stop_id
            ORDER BY arrival_time
            LIMIT 3
        ", ['route_id' => $routeId, 'stop_id' => $stopId]);
    }
}