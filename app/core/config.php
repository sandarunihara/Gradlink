<?php

    if($_SERVER['SERVER_NAME'] == 'localhost'){
        // database configuration
        define('DBNAME', 'gradlink');   // database name
        define('DBHOST', 'localhost');  
        define('DBUSER', 'root');
        define('DBPASS', '');
        define('DBDRIVER', '');

        define('ROOT', 'http://localhost/Gradlink/public');
    } else {
        // database configuration
        define('DBNAME', 'gradlink');   // database name
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

