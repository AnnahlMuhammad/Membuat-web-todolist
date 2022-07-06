<?php 

require_once __DIR__ . "/Entity/entityTodoList.php";
require_once __DIR__ . "/Repository/todoListRepository.php";
require_once __DIR__ . "/Service/todoListService.php";
require_once __DIR__ . "/Config/database.php";


use Service\TodolistServiceImpl;
use Repository\TodolistRepositoryImpl;
use Config\Database;


$connection = Database::getConnection();
$todolistRepository = new TodolistRepositoryImpl($connection);
$todolistService = new TodolistServiceImpl($todolistRepository);

$todolists = $todolistService->showTodolist();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My TodoList</title>
</head>
<body>
    <h1>My Todolist</h1>
    <ol>
        <?php foreach($todolists as $value) { ?>
        <li><?= $value->getTodolist()?></li>
        <?php } ?>
    </ol>
</body>
</html>