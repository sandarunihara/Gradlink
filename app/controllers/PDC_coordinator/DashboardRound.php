<?php

class DashboardRound
{
    use Controller;
    public function index()
    {
        $model = new round;
        $data = $model->findall();

        if ($data == false || empty($data)) {
            $this->view('Coordinator/Round/dashboardRound');
        } else {
            $roundData = [];

            foreach ($data as $roundDetail) {
                $roundData[] = [
                    'round_id' => $roundDetail->roundId,
                    'round' => $roundDetail->round,
                    'active' => $roundDetail->active,
                    'startDate' => $roundDetail->startDate,
                    'endDate' => $roundDetail->endDate
                ];
            }
            $this->view('Coordinator/Round/dashboardRound', ['roundData' => $roundData]);
        }


    }
}