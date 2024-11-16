<?php
class RouteController {
    private $routeModel;

    public function __construct(RouteModel $routeModel) {
        $this->routeModel = $routeModel;
    }

    public function editRoute($routeId, $stops) {
        $this->routeModel->editRoute($routeId, $stops);
        return json_encode(['status' => 'success']);
    }
}