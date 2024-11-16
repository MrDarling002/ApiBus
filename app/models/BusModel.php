<?php
class BusModel {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getBusesByStops($from, $to) {
        return $this->db->query("
            SELECT b.number, r.direction, s.name AS from_stop, s2.name AS to_stop, sc.arrival_time
            FROM Route r
            JOIN Bus b ON r.bus_id = b.id
            JOIN RouteStop rs ON r.id = rs.route_id
            JOIN Stop s ON rs.stop_id = s.id
            JOIN RouteStop rs2 ON r.id = rs2.route_id
            JOIN Stop s2 ON rs2.stop_id = s2.id
            JOIN Schedule sc ON r.id = sc.route_id AND sc.stop_id = s.id
            WHERE s.id = :from AND s2.id = :to
            ORDER BY sc.arrival_time
            LIMIT 3
        ", ['from' => $from, 'to' => $to]);
    }
}