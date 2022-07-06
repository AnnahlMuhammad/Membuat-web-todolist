<?php 

require_once __DIR__ . "/Entity/entityTodoList.php";
require_once __DIR__ . "/Repository/todoListRepository.php";
require_once __DIR__ . "/Service/todoListService.php";
require_once __DIR__ . "./Config/database.php";


use Service\TodolistServiceImpl;
use Repository\TodolistRepositoryImpl;
use Config\Database;


$connection = Database::getConnection();
$todolistRepository = new TodolistRepositoryImpl($connection);
$todolistService = new TodolistServiceImpl($todolistRepository);

if ($_SERVER["REQUEST_METHOD"]== "POST"){
    header("Location: mytodo.php");
    $todolistService->addTodolist($_POST["todo"]);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD TODOLIST</title>
</head>
<body>
    <h1>Tambah todolist</h1>
    <form action="/add-todolist.php" method="POST">
        <label>Todo</label>
        <input type="text" name="todo">
        <input type="submit" value="add">
    </form>
    <a href="/mytodo.php">Kembali</a>
</body>
</html>