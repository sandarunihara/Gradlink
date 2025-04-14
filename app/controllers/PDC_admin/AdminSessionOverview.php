<?php

    class AdminSessionOverview{
        use Controller;
        public function dashboard(){
            
            $model = new PDC_Session;
            $sessionData = $model->findall();

            // show(
            //     $sessionData
            // );

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

        public function unregistered(){
            $model = new PDC_Unreg_Session;
            $sessionData = $model->findAll();

            $this->view('PDC_admin/Session/SessionNull', 
            ['sessionData' => $sessionData,
            'activeTab' => 'unregisteredCompany'
            ]);
        }
    }