<?php
    Trait Database{

        private static $con = null;

        private function connect(){
            if(self::$con === null){
                try{
                    $string = DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME;
                    self::$con = new PDO($string, DBUSER, DBPASS);
                    self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(PDOException $e){
                    if(DEBUG){
                        die("Database connection failed: " . $e->getMessage());
                    }else{
                        die("Database connection failed.");
                    }
                }
            }
            return self::$con;
            // $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
            // try {
            //     $con = new PDO($string, DBUSER, DBPASS);
            //     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //     return $con;
            // } catch (PDOException $e) {
            //     die("Database connection failed: " . $e->getMessage());
            // }
        }
        public function query($query, $data = []){
            $con = $this->connect();
            $stmt = $con->prepare($query);
            $check = $stmt->execute($data);

            if($check){
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                if(is_array($result) && count($result)){
                    return $result;
                }  
            }
            

            return false;
        }
        
        public function get_row($query, $data = []){
            $con = $this->connect();
            $stmt = $con->prepare($query);
            $check = $stmt->execute($data);

            if($check){
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                if(is_array($result) && count($result)){
                    return $result[0];
                }  
            }

            $con = null;
            return false;
        }
        // Close connection if needed
        public static function closeConnection() {
            if (self::$con) {
                self::$con = null;
            }
        }

        // Destructor to ensure the connection is closed
        public function __destruct() {
            self::closeConnection();
        }
    }

