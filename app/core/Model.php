<?php

    // Main model trait

    Trait Model{
        use Database;
        public $errors = [];

        protected $limit = 10;
        protected $offset = 0;
        //$order_type = asc or desc or do_not_order

        public function findAll($order_column, $order_type){

            if($order_type != 'do_not_order'){
                $query = "SELECT * FROM $this->table ORDER BY $order_column $order_type LIMIT $this->limit OFFSET $this->offset";
            }else{
                $query = "SELECT * FROM $this->table LIMIT $this->limit OFFSET $this->offset";
            }
            return $this->query($query);
        }

        public function where($data, $data_not =[], $order_column, $order_type){ //where function example where($arr,[], 'Date', 'asc');
            $keys = array_keys($data);
            $keys_not = array_keys($data_not);
            $query = "SELECT * FROM $this->table WHERE ";

            foreach ($keys as $key) {
                $query .= $key . " = :". $key . " && ";
            }
            foreach ($keys_not as $key) {
                $query .= $key . " != :". $key . " && ";
            }
            $query = trim($query, " && ");
            if($order_type != 'do_not_order'){
                $query .= " ORDER BY $order_column $order_type LIMIT $this->limit OFFSET $this->offset";
            }

            //echo $query;
            $data = array_merge($data, $data_not);
            return $this->query($query, $data);
        }

        public function first($data, $data_not = []){
            $keys = array_keys($data);
            $keys_not = array_keys($data_not);
            $query = "SELECT * FROM $this->table WHERE ";

            foreach ($keys as $key) {
                $query .= $key . " = :". $key . " && ";
            }
            foreach ($keys_not as $key) {
                $query .= $key . " != :". $key . " && ";
            }
            $query = trim($query, " && ");
            $query .= " LIMIT $this->limit OFFSET $this->offset";

            //echo $query;
            $data = array_merge($data, $data_not);
            $result = $this->query($query, $data);
            if($result)
                return $result[0];
            return false;
        }

        public function insert($data){
        
            /*remove unwanted data*/
            if(!empty($this->allowedColumns)){
                foreach ($data as $key => $value) {
                    if(!in_array($key, $this->allowedColumns)){
                        unset($data[$key]);
                    }
                }
            }
            
            $keys = array_keys($data);
            $query = "INSERT INTO $this->table (".implode(",", $keys).") VALUES (:".implode(", :", $keys).")";
            //echo $query;
            $this->query($query, $data);

            return true;
        }


        public function update($id, $data, $id_column) {

            try {
                /* Remove unwanted data */
                if (!empty($this->allowedColumns)) {
                    foreach ($data as $key => $value) {
                        if (!in_array($key, $this->allowedColumns)) {
                            unset($data[$key]);
                        }
                    }
                }
        
                $keys = array_keys($data);
                $query = "UPDATE $this->table SET ";
        
                foreach ($keys as $key) {
                    $query .= $key . " = :$key, ";
                }
        
                $query = trim($query, ", ");
                $query .= " WHERE $id_column = :$id_column";
        
                // Add the ID to the data array
                $data[$id_column] = $id;
        
                // Execute the query
                $this->query($query, $data);
        
                // Return a success message if update is successful
                return [
                    'status' => 'success',
                    'message' => 'Record updated successfully.'
                ];
        
            } catch (Exception $e) {
                // Catch any errors and return an error message
                return [
                    'status' => 'error',
                    'message' => 'Failed to update record: ' . $e->getMessage()
                ];
            }
        }
        

        
        public function delete($id, $id_column) {
            $data[$id_column] = $id;
            $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
            
            // Execute the query
            $stmt = $this->query($query, $data);
            if (is_array($stmt)) {
                $stmt = (object) $stmt;
            }
        
            // Check if the query was successful and if it returned a valid statement
            if ($stmt && $stmt->rowCount() > 0) {
                return "Record deleted successfully.";
            } else {
                return "Error: Record could not be deleted.";
            }
        }
        
    }