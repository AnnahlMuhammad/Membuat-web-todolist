<?php 
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/src/Entity/entityTodoList.php";
require_once __DIR__ . "/src/Repository/todoListRepository.php";
require_once __DIR__ . "/src/Service/todoListService.php";
require_once __DIR__ . "/src/Config/database.php";
require_once __DIR__ . "/secret.php";



use Service\TodolistServiceImpl;
use Repository\TodolistRepositoryImpl;
use Config\Database;


$connection = Database::getConnection();
$todolistRepository = new TodolistRepositoryImpl($connection);
$todolistService = new TodolistServiceImpl($todolistRepository);

$SECRET_KEY = Secret::$SECRET_KEY;

$status_login= '';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($todolistService->cekDataLogin($_POST["email"], $_POST["password"])==true){
        $payload = [
                "username" => $_POST["email"],
                "role" => "member"
            ];
        $jwt = \Firebase\JWT\JWT::encode($payload, $SECRET_KEY, 'HS256');
        setcookie("X-USER-TOKEN", $jwt);
        header("Location:/home.php");
    } else if ($todolistService->cekDataLogin($_POST["email"], $_POST["password"]) != true){
        $status_login = "User is not found";
    }
} 



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<body>
    <?php if ($status_login !=''){ ?>
        <h1><?= $status_login ?></h1>
    <?php } ?>
    <h1>FORM LOGIN</h1>
    <form action="/login.php" method="POST">
        <label>Email</label>
        <input type="email" name="email"><br>
        <label>Password</label>
        <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>