<?php 

require_once __DIR__ . "/database.php";
use Config\Database;

Database::getConnection();
echo "Sukses terhubug ke database";



?>