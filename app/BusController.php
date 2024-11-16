<?php
class BusController {
    private $busModel;
    private $stopModel;

    public function __construct(BusModel $busModel, StopModel $stopModel) {
        $this->busModel = $busModel;
        $this->stopModel = $stopModel;
    }

    public function findBus($from, $to) {
        $buses = $this->busModel->getBusesByStops($from, $to);

        $response = [
            'from' => $this->stopModel->getStopName($from),
            'to' => $this->stopModel->getStopName($to),
            'buses' => []
        ];

        foreach ($buses as $bus) {
            $response['buses'][] = [
                'route' => "Автобус No{$bus['number']} в сторону ост. {$bus['direction']}",
                'next_arrivals' => [$bus['arrival_time']]
            ];
        }

        return json_encode($response);
    }
}