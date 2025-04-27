<?php
    class Progress_doc
    {
        
        use Model;

        protected $table = 'progress_doc';

        protected $allowedColumns = [

            'DocumentId',
            'SubmissionDate',
            'Status',
            'StudentId',
            'Name',
        ];

        public function find($data)
    {
        
        if (is_array($data)) {
            $keys = array_keys($data);
            $query = "SELECT * FROM $this->table WHERE ";

            foreach ($keys as $key) {
                $query .= $key . " = :" . $key . " AND ";
            }

            $query = trim($query, "AND "); // Trim the trailing "AND"

            $result = $this->query($query, $data);
        } else {
            // Assume $data is a single ID (like CompanyId)
            $query = "SELECT * FROM $this->table WHERE StudentId = :StudentId";
            $result = $this->query($query, ['StudentId' => $data]);
        }

        return $result;
    }

    public function findstudent($StudentId) {
        $query = "SELECT r.*, r.Status AS reportStatus 
                  FROM $this->table r 
                  WHERE r.StudentId = :StudentId";
                  
        $params = ['StudentId' => $StudentId];
        $result = $this->query($query, $params);
        
        return $result;
    }


    }