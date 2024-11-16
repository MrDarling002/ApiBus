<?php
require_once __DIR__ . '/../app/Database.php';
require_once __DIR__ . '/../app/models/BusModel.php';
require_once __DIR__ . '/../app/models/RouteModel.php';
require_once __DIR__ . '/../app/models/StopModel.php';
require_once __DIR__ . '/../app/models/ScheduleModel.php';
require_once __DIR__ . '/../app/BusController.php';
require_once __DIR__ . '/../app//RouteController.php';

$db = new Database();
$busModel = new BusModel($db);
$routeModel = new RouteModel($db);
$stopModel = new StopModel($db);
$scheduleModel = new ScheduleModel($db);

$busController = new BusController($busModel, $stopModel);
$routeController = new RouteController($routeModel);

$requestUri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

if ($requestUri === '/api/find-bus' && $method === 'GET') {
    $from = $_GET['from'] ?? null;
    $to = $_GET['to'] ?? null;

    if (!$from || !$to) {
        echo json_encode(['error' => 'Missing parameters']);
        exit;
    }

    echo $busController->findBus($from, $to);
} elseif ($requestUri === '/api/edit-route' && $method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $routeId = $data['routeId'] ?? null;
    $stops = $data['stops'] ?? null;

    if (!$routeId || !$stops) {
        echo json_encode(['error' => 'Missing parameters']);
        exit;
    }

    echo $routeController->editRoute($routeId, $stops);
} else {
    echo json_encode(['error' => 'Invalid request']);
}