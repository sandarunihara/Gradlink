<?php
    Trait Database{

        private static $connection = null;

        // for local host
        private function connect(){
            $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
            try {
                $con = new PDO($string, DBUSER, DBPASS);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $con;
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        //for alwaysdata *****meka makanna epaaa****
        // private function connect() {
        //     if (self::$connection === null) {
        //         try {
        //             $dsn = DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME;
        //             self::$connection = new PDO($dsn, DBUSER, DBPASS);
        //             self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //         } catch (PDOException $e) {
        //             if (DEBUG) {
        //                 die("Database connection failed: " . $e->getMessage());
        //             } else {
        //                 die("Database connection failed.");
        //             }
        //         }
        //     }
        //     return self::$connection;
        // }            
        
        // Execute a query with optional data
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
            if (self::$connection) {
                self::$connection = null;
            }
        }
        // Destructor to ensure the connection is closed
        public function __destruct() {
            self::closeConnection();
        }
    }
  