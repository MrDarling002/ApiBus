<?php
class RouteModel {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function editRoute($routeId, $stops) {
        $this->db->query("DELETE FROM RouteStop WHERE route_id = :route_id", ['route_id' => $routeId]);

        foreach ($stops as $order => $stopId) {
            $this->db->query("INSERT INTO RouteStop (route_id, stop_id, stop_order) VALUES (:route_id, :stop_id, :order)", [
                'route_id' => $routeId,
                'stop_id' => $stopId,
                'order' => $order
            ]);
        }
    }
}