<?php

require_once __DIR__ . '/../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if($_SERVER['SERVER_NAME'] == 'localhost'){
    // database configuration
    define('DBNAME', $_ENV["DBNAME"]);   // database name
    define('DBHOST', $_ENV["DBHOST"]);  
    define('DBUSER', $_ENV["DBUSER"]);
    define('DBPASS', $_ENV["DBPASS"]);
    define('DBDRIVER', $_ENV["DBDRIVER"]);

    define('ROOT', 'http://localhost/Gradlink/public');
} else {
    // database configuration
    define('DBNAME', 'gradlink1');   // database name
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');
    
    define('ROOT', 'https://Gradlink.com');
}
define('APP_NAME', 'Gradlink');
define('APP_DESC', "Undergraduate internship management system");

//true means show errors
define('DEBUG', true);


    