<?php
    class student_skill
    {
        
        use Model;

        protected $table = 'student_skill';

        protected $allowedColumns = [

            'StudentId',
            'Skill',
        ];

        public function insertSkill($studentId , $skills){
            try{
                $values = [];
                foreach ($skills as $skill) {
                    $values[] = "('$studentId', '" . htmlspecialchars($skill, ENT_QUOTES, 'UTF-8') . "')";
                }
            
                // Convert the array into a string of comma-separated values
                $query = "
                    INSERT INTO student_skill (StudentId, Skill) 
                    VALUES " . implode(',', $values) . ";";
                
                // Execute the query
                $result = $this->query($query);
                return 1;
            }catch(Exception $e){
                //show($e -> getMessage());
                return 0;
            }

        }
        public function deleteSkil($id, $id_column) {
            $data[$id_column] = $id;
            $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
            //show($query);
            $result = $this->query($query, $data);
            //show($result);
            if($result) {
                return false;
            } else {
                return true;
            }
        }
    }