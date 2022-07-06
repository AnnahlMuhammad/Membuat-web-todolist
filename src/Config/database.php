<?php 
namespace Config{

    use PDO;

    class Database{
        static public function getConnection():PDO{
            $servername = "localhost";
            $port = 3306;
            $username = "root";
            $password = "annahl88";
            $dbname = "belajar_php_todolist";

            return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        }
    }

}



?>