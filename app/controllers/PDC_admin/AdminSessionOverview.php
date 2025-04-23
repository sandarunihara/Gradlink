<?php

    class AdminSessionOverview{
        use Controller;
        public function dashboard(){
            
            $model = new PDC_Session;
            $sessionData = $model->findall();
            //show($sessionData);

            $this->view('PDC_admin/Session/SessionOverview', 
            ['sessionData' => $sessionData,
            'activeTab' => 'upcoming'
            ]);
        }

        public function completed(){
            $model = new PDC_Session;
            $unregisteredModel = new PDC_Unreg_Session;
            $sessionData = $model->findCompleted();
            $sessionDataUnregistered = $unregisteredModel->findCompleted();

            $data = array_merge(
                is_array($sessionData) ? $sessionData : [],
                is_array($sessionDataUnregistered) ? $sessionDataUnregistered : []
            );
                        //show($data);

            $this->view('PDC_admin/Session/SessionCompleted', 
            ['sessionData' => $data,
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