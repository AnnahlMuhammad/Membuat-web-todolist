<?php 
require_once __DIR__ . "/vendor/autoload.php";

setcookie("X-USER-TOKEN", "LOGOUT");

header("Location: /home.php");

?>