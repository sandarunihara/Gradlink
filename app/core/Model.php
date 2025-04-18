<?php

    // Main model trait

    Trait Model{
        use Database;
        public $errors = [];

        protected $limit = 10;
        protected $offset = 0;
        //$order_type = asc or desc or do_not_order

        public function findAll($order_column, $order_type, $customLimit){

            if($order_type != 'do_not_order'){
                $query = "SELECT * FROM $this->table ORDER BY $order_column $order_type";
            }else{
                $query = "SELECT * FROM $this->table";
            }
            if($customLimit != 'do_not_limit'){
                $query .= " LIMIT $customLimit OFFSET $this->offset";
            }else{
                $query .= " LIMIT $this->limit OFFSET $this->offset";
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

        public function orWhere($data, $data_not = [], $order_column = '', $order_type = 'ASC') {
            $keys = array_keys($data);
            $keys_not = array_keys($data_not);
            $query = "SELECT * FROM $this->table WHERE ";
            
            foreach ($keys as $key) {
                $query .= $key . " = :" . $key . " OR ";
            }
            
            foreach ($keys_not as $key) {
                $query .= $key . " != :" . $key . " OR ";
            }
            
            $query = trim($query, " OR ");
            
            if (!empty($order_column) && $order_type != 'do_not_order') {
                $query .= " ORDER BY $order_column $order_type";
            }
            
            if ($this->limit !== false) {
                $query .= " LIMIT $this->limit";
            }
            if ($this->offset !== false) {
                $query .= " OFFSET $this->offset";
            }
            
            $merged_data = array_merge($data, $data_not);
            return $this->query($query, $merged_data);
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
            //show($query);
            $this->query($query, $data);

            return true;
        }

        public function update($id, $data, $id_column) {

            try {
                //echo ($this->table);
                //$this->table = get_class($this);
                //show($this->table);                
                if (!empty($this->allowedColumns)) {
                    foreach ($data as $key => $value) {
                        if (!in_array($key, $this->allowedColumns)) {
                            unset($data[$key]);
                        }
                    }
                }

                if (isset($data['StudentId'])) {
                    $new_id = $data['StudentId'];
                    unset($data['StudentId']);
                
                    $data['StudentId'] = $new_id;
                    $query = "UPDATE $this->table SET ";
                
                    foreach ($data as $key => $value) {
                        $query .= "$key = :$key, ";
                    }
                
                    $query = rtrim($query, ", ");
                    $query .= " WHERE $id_column = :old_id";
                
                    $data['old_id'] = $id;
                }
                
                
                else{
                    
                    $query = "UPDATE $this->table SET ";

                    foreach ($data as $key => $value) {
                        $query .= "$key = :$key, ";
                    }
                    
                    $query = rtrim($query, ", ");

                    $query .= " WHERE $id_column = :$id_column";
                    
                    //show($r);

                    $data[$id_column] = $id;
                }
        
                $this->query($query, $data);
                return [
                    'status' => 'success',
                    'message' => 'Record updated successfully.'
                ];
        
            } catch (Exception $e) {
                return [
                    'status' => 'error',
                    'message' => 'Failed to update record: ' . $e->getMessage()
                ];
            }
        }
        

        
        public function delete($id, $id_column) {
            $data[$id_column] = $id;
            $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
            //show($query);
            $result = $this->query($query, $data);
            //show($result);
            if($result) {
                return true;
            } else {
                return false;
            }
        }

        /* Transaction Methods*/
        public function beginTransaction(){
            $this->connect()->beginTransaction(); //begin the transaction with calling pdo beginTransaction
        }

        //commit the transaction
        public function commit(){
            $this->connect()->commit(); //commit the transaction with calling pdo commit
        }

        //rollback if any error occurs
        public function rollBack(){
            $this->connect()->rollBack(); //rollback the transaction with calling pdo rollBack
        }        
    }