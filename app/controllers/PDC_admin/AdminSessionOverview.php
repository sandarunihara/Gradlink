<?php

    class AdminSessionOverview{
        use Controller;
        public function dashboard(){
            
            $model = new PDC_Session;
            $sessionData = $model->findall();

            $this->view('PDC_admin/Session/SessionOverview', 
            ['sessionData' => $sessionData,
            'activeTab' => 'upcoming'
            ]);
        }

        public function completed(){
            $model = new PDC_Session;
            $sessionData = $model->findCompleted();

            $this->view('PDC_admin/Session/SessionOverview', 
            ['sessionData' => $sessionData,
            'activeTab' => 'completed'
            ]);

        }
    }